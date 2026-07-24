<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NormalizeProductsOptionA extends Command
{
    protected $signature = 'products:normalize-option-a
                            {--dry-run : Preview changes without writing}
                            {--acknowledge-variants : Required when variant groups exist and each row should become its own product}';

    protected $description = 'Migrate product metadata from product_images into products (Option A) without losing data';

    public function handle(): int
    {
        if (! Schema::hasTable('product_images') || ! Schema::hasTable('products')) {
            $this->error('Required tables are missing.');

            return self::FAILURE;
        }

        if ($this->hasVariantGroups() && ! $this->option('acknowledge-variants')) {
            $this->error('Variant groups detected. Run products:verify-independence first.');
            $this->line('If you intend to promote each variant row to its own products record, rerun with --acknowledge-variants');

            return self::FAILURE;
        }

        $dryRun = (bool) $this->option('dry-run');
        $metadataFields = $this->metadataFields();

        if (empty($metadataFields)) {
            $this->info('product_images already appears image-only. Ensuring orphan products have gallery rows only.');

            return $this->ensureOrphanProductImages($dryRun);
        }

        $images = DB::table('product_images')->orderBy('id')->get();

        if ($images->isEmpty()) {
            $this->warn('No product_images rows found.');

            return self::SUCCESS;
        }

        $legacyParentIds = $images->pluck('product_id')->unique()->values()->all();
        $orphans = DB::table('products')
            ->whereNotIn('id', DB::table('product_images')->select('product_id'))
            ->get();

        $this->info('Rows to promote: ' . $images->count());
        $this->info('Legacy parent products to archive: ' . count($legacyParentIds));
        $this->info('Orphan products needing images: ' . $orphans->count());

        if ($dryRun) {
            $this->comment('Dry run complete. No changes written.');

            return self::SUCCESS;
        }

        DB::beginTransaction();

        try {
            if (Schema::hasTable('products_legacy')) {
                foreach ($legacyParentIds as $parentId) {
                    $parent = DB::table('products')->where('id', $parentId)->first();
                    if (! $parent) {
                        continue;
                    }

                    $exists = DB::table('products_legacy')->where('original_id', $parentId)->exists();
                    if (! $exists) {
                        DB::table('products_legacy')->insert([
                            'original_id' => $parent->id,
                            'name' => $parent->name,
                            'category' => $parent->category,
                            'price' => $parent->price,
                            'description' => $parent->description,
                            'image' => $parent->image,
                            'material' => $parent->material,
                            'color' => $parent->color,
                            'stock' => $parent->stock,
                            'discount' => $parent->discount,
                            'created_at' => $parent->created_at,
                            'updated_at' => $parent->updated_at,
                            'archived_at' => now(),
                        ]);
                    }
                }
            }

            foreach ($images as $row) {
                $productData = [
                    'name' => $row->name,
                    'category' => $row->category,
                    'price' => $row->price,
                    'description' => $row->description,
                    'image' => $this->normalizeImagePath($row->image),
                    'material' => $row->material,
                    'color' => $row->color,
                    'stock' => $row->stock,
                    'discount' => $row->discount,
                    'created_at' => $row->created_at ?? now(),
                    'updated_at' => now(),
                ];

                $newProductId = DB::table('products')->insertGetId($productData);

                DB::table('product_images')->where('id', $row->id)->update([
                    'product_id' => $newProductId,
                    'sort_order' => 0,
                    'is_featured' => true,
                    'updated_at' => now(),
                ]);
            }

            foreach ($orphans as $orphan) {
                $exists = DB::table('product_images')->where('product_id', $orphan->id)->exists();
                if ($exists) {
                    continue;
                }

                $filename = basename((string) $orphan->image);

                DB::table('product_images')->insert([
                    'product_id' => $orphan->id,
                    'name' => $orphan->name,
                    'category' => $orphan->category,
                    'price' => $orphan->price,
                    'description' => $orphan->description,
                    'image' => $filename,
                    'material' => $orphan->material,
                    'color' => $orphan->color,
                    'stock' => $orphan->stock,
                    'discount' => $orphan->discount,
                    'sort_order' => 0,
                    'is_featured' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('products')->whereIn('id', $legacyParentIds)->delete();

            DB::commit();

            $this->info('Option A data migration completed successfully.');

            return self::SUCCESS;
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error('Migration failed: ' . $e->getMessage());

            return self::FAILURE;
        }
    }

    private function hasVariantGroups(): bool
    {
        $fields = $this->metadataFields();
        if (empty($fields)) {
            return false;
        }

        $rows = DB::table('product_images')->get()->groupBy('product_id');

        foreach ($rows as $group) {
            if ($group->count() <= 1) {
                continue;
            }

            $signatures = $group->map(function ($row) use ($fields) {
                $parts = [];
                foreach ($fields as $field) {
                    $parts[] = $field . '=' . ($row->{$field} ?? '');
                }

                return implode('|', $parts);
            })->unique();

            if ($signatures->count() > 1) {
                return true;
            }
        }

        return false;
    }

    private function metadataFields(): array
    {
        $fields = ['name', 'category', 'price', 'description', 'material', 'color', 'stock', 'discount'];

        return array_values(array_filter($fields, fn ($field) => Schema::hasColumn('product_images', $field)));
    }

    private function normalizeImagePath(string $filename): string
    {
        if (str_contains($filename, '/')) {
            return $filename;
        }

        return 'images/' . ltrim($filename, '/');
    }

    private function ensureOrphanProductImages(bool $dryRun): int
    {
        $orphans = Product::query()
            ->whereDoesntHave('images')
            ->get();

        if ($orphans->isEmpty()) {
            $this->info('No orphan products without images.');

            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->line('Would create product_images rows for product ids: ' . $orphans->pluck('id')->implode(', '));

            return self::SUCCESS;
        }

        foreach ($orphans as $product) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => basename((string) $product->image),
                'sort_order' => 0,
                'is_featured' => true,
            ]);
        }

        $this->info('Created gallery rows for orphan products.');

        return self::SUCCESS;
    }
}
