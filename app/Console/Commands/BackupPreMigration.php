<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackupPreMigration extends Command
{
    protected $signature = 'products:backup-pre-migration';

    protected $description = 'Create a timestamped SQL dump and record public image paths before Option A migration';

    public function handle(): int
    {
        $timestamp = now()->format('Y_m_d_His');
        $backupDir = storage_path('app/backups');

        if (! is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');
        $dbHost = config('database.connections.mysql.host');
        $sqlFile = $backupDir . DIRECTORY_SEPARATOR . "backup_pre_option_a_{$timestamp}.sql";

        $mysqldump = 'mysqldump';
        $passwordArg = $dbPass !== '' && $dbPass !== null
            ? '-p' . escapeshellarg($dbPass)
            : '';

        $command = sprintf(
            '%s -h %s -u %s %s %s > %s',
            $mysqldump,
            escapeshellarg($dbHost),
            escapeshellarg($dbUser),
            $passwordArg,
            escapeshellarg($dbName),
            escapeshellarg($sqlFile)
        );

        exec($command, $output, $exitCode);

        if ($exitCode !== 0 || ! file_exists($sqlFile) || filesize($sqlFile) === 0) {
            $this->warn('mysqldump unavailable or failed. Falling back to copying existing project SQL backup.');

            $existing = base_path('database_backup_1780292920.sql');
            if (file_exists($existing)) {
                copy($existing, $sqlFile);
                $this->info('Copied existing backup to: ' . $sqlFile);
            } else {
                $this->error('Could not create database backup.');

                return self::FAILURE;
            }
        } else {
            $this->info('Database backup created: ' . $sqlFile);
        }

        $manifest = [
            'created_at' => now()->toIso8601String(),
            'database' => $dbName,
            'sql_file' => $sqlFile,
            'sql_bytes' => filesize($sqlFile),
            'image_paths' => [
                'public/images' => $this->directoryManifest(public_path('images')),
                'public/uploads/products' => $this->directoryManifest(public_path('uploads/products')),
            ],
            'row_counts' => $this->rowCounts(),
        ];

        $manifestFile = $backupDir . DIRECTORY_SEPARATOR . "backup_manifest_{$timestamp}.json";
        file_put_contents($manifestFile, json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info('Backup manifest: ' . $manifestFile);

        return self::SUCCESS;
    }

    private function directoryManifest(string $path): array
    {
        if (! is_dir($path)) {
            return ['exists' => false, 'files' => []];
        }

        $files = [];
        foreach (scandir($path) as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            $full = $path . DIRECTORY_SEPARATOR . $entry;
            if (is_file($full)) {
                $files[] = ['name' => $entry, 'bytes' => filesize($full)];
            }
        }

        return ['exists' => true, 'file_count' => count($files), 'files' => $files];
    }

    private function rowCounts(): array
    {
        $tables = ['products', 'product_images', 'carts', 'orders', 'wishlists'];
        $counts = [];

        foreach ($tables as $table) {
            $counts[$table] = Schema::hasTable($table) ? DB::table($table)->count() : null;
        }

        return $counts;
    }
}
