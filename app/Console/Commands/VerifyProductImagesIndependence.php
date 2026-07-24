<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VerifyProductImagesIndependence extends Command
{
    protected $signature = 'products:verify-independence';

    protected $description = 'Verify whether product_images rows are independent products or variants of a shared parent';

    public function handle(): int
    {
        if (! Schema::hasTable('product_images')) {
            $this->error('product_images table does not exist.');

            return self::FAILURE;
        }

        $columns = Schema::getColumnListing('product_images');
        $metadataFields = ['name', 'category', 'price', 'description', 'material', 'color', 'stock', 'discount'];
        $availableFields = array_values(array_intersect($metadataFields, $columns));

        if (empty($availableFields)) {
            $this->info('No duplicate metadata columns found on product_images — schema may already be normalized.');
            $this->info('Each row is treated as an image-only record linked to products.');

            return self::SUCCESS;
        }

        $rows = DB::table('product_images')
            ->select(array_merge(['id', 'product_id', 'image'], $availableFields))
            ->orderBy('product_id')
            ->orderBy('id')
            ->get();

        if ($rows->isEmpty()) {
            $this->warn('product_images table is empty.');

            return self::SUCCESS;
        }

        $grouped = $rows->groupBy('product_id');
        $galleryGroups = [];
        $variantGroups = [];
        $singleImageProducts = [];

        foreach ($grouped as $productId => $groupRows) {
            $parent = DB::table('products')->where('id', $productId)->first();
            $parentName = $parent->name ?? '(missing parent)';

            if ($groupRows->count() === 1) {
                $singleImageProducts[] = [
                    'product_id' => $productId,
                    'parent_name' => $parentName,
                    'image_id' => $groupRows->first()->id,
                ];

                continue;
            }

            $signatures = $groupRows->map(function ($row) use ($availableFields) {
                $parts = [];
                foreach ($availableFields as $field) {
                    $parts[] = $field . '=' . ($row->{$field} ?? '');
                }

                return implode('|', $parts);
            })->unique();

            $groupInfo = [
                'product_id' => $productId,
                'parent_name' => $parentName,
                'row_count' => $groupRows->count(),
                'unique_metadata_signatures' => $signatures->count(),
                'image_ids' => $groupRows->pluck('id')->all(),
                'rows' => $groupRows->map(function ($row) use ($availableFields) {
                    $summary = ['id' => $row->id, 'image' => $row->image];
                    foreach ($availableFields as $field) {
                        $summary[$field] = $row->{$field};
                    }

                    return $summary;
                })->all(),
            ];

            if ($signatures->count() === 1) {
                $galleryGroups[] = $groupInfo;
            } else {
                $variantGroups[] = $groupInfo;
            }
        }

        $this->newLine();
        $this->info('=== Product Images Independence Verification ===');
        $this->line('Total product_images rows: ' . $rows->count());
        $this->line('Distinct parent product_id groups: ' . $grouped->count());
        $this->line('Single-image products: ' . count($singleImageProducts));
        $this->line('Gallery groups (same metadata, multiple images): ' . count($galleryGroups));
        $this->line('Variant groups (different metadata under same product_id): ' . count($variantGroups));
        $this->newLine();

        if (! empty($galleryGroups)) {
            $this->info('Gallery-only groups (safe for Option A as multiple images):');
            foreach ($galleryGroups as $group) {
                $this->line(sprintf(
                    '  product_id=%s (%s): %d images, identical metadata',
                    $group['product_id'],
                    $group['parent_name'],
                    $group['row_count']
                ));
            }
            $this->newLine();
        }

        if (! empty($variantGroups)) {
            $this->error('VARIANT GROUPS DETECTED — migration must NOT auto-promote these rows without a decision.');
            foreach ($variantGroups as $group) {
                $this->line(sprintf(
                    '  product_id=%s (%s): %d rows, %d unique metadata signatures',
                    $group['product_id'],
                    $group['parent_name'],
                    $group['row_count'],
                    $group['unique_metadata_signatures']
                ));

                foreach ($group['rows'] as $row) {
                    $this->line(sprintf(
                        '    - image id=%s name=%s price=%s material=%s color=%s',
                        $row['id'],
                        $row['name'] ?? 'n/a',
                        $row['price'] ?? 'n/a',
                        $row['material'] ?? 'n/a',
                        $row['color'] ?? 'n/a'
                    ));
                }
            }
            $this->newLine();
        }

        $reportPath = storage_path('app/migration_reports/product_images_verification_' . now()->format('Y_m_d_His') . '.json');
        if (! is_dir(dirname($reportPath))) {
            mkdir(dirname($reportPath), 0755, true);
        }

        file_put_contents($reportPath, json_encode([
            'verified_at' => now()->toIso8601String(),
            'total_rows' => $rows->count(),
            'single_image_products' => $singleImageProducts,
            'gallery_groups' => $galleryGroups,
            'variant_groups' => $variantGroups,
            'migration_blocked' => ! empty($variantGroups),
            'recommendation' => ! empty($variantGroups)
                ? 'STOP: Rows share a product_id but have different product metadata. Confirm whether to promote each row to its own products record (preserves all data) or merge into parent products (data loss risk).'
                : 'Proceed: All multi-image groups share identical metadata.',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info('Report saved: ' . $reportPath);

        if (! empty($variantGroups)) {
            $this->newLine();
            $this->error('MIGRATION BLOCKED: Variant groups found. Review the report before running products:normalize-option-a.');

            return self::FAILURE;
        }

        $this->info('Verification passed. Safe to proceed with Option A data migration.');

        return self::SUCCESS;
    }
}
