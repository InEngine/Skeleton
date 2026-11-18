<?php

namespace VendorName\Skeleton;

use InEngine\Modulus\ModuleServiceProvider;
use Spatie\LaravelPackageTools\Package;
use VendorName\Skeleton\Commands\SkeletonCommand;
use VendorName\Skeleton\Database\Seeders\ModuleSeeder;

class SkeletonServiceProvider extends ModuleServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * Modulus-compatible feature module (Spatie laravel-package-tools).
         *
         * Boot runs only when Modulus reports this package enabled, or when
         * Modulus is absent (standalone). See InEngine\Modulus\ModuleServiceProvider.
         *
         * Ship resources/dist for install-time Modulus::publish() (JS/CSS assets).
         * See resources/ASSETS.md. Seed only via Modulus::seed(..., confirmed: true).
         */
        $package
            ->name('skeleton')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasMigration('create_migration_table_name_table')
            ->hasCommand(SkeletonCommand::class);
    }

    protected function modulusPackageName(): string
    {
        return ':vendor_slug/:package_slug';
    }

    /**
     * {@inheritdoc}
     *
     * @return class-string<ModuleSeeder>
     */
    public function modulusSeederClass(): ?string
    {
        return ModuleSeeder::class;
    }
}
