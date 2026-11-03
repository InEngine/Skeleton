<?php

namespace VendorName\Skeleton;

use InEngine\Modulus\ModuleServiceProvider;
use Spatie\LaravelPackageTools\Package;
use VendorName\Skeleton\Commands\SkeletonCommand;

class SkeletonServiceProvider extends ModuleServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * Modulus-compatible feature module (Spatie laravel-package-tools).
         *
         * Boot runs only when Modulus reports this package enabled, or when
         * Modulus is absent (standalone). See InEngine\Modulus\ModuleServiceProvider.
         */
        $package
            ->name('skeleton')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_migration_table_name_table')
            ->hasCommand(SkeletonCommand::class);
    }

    protected function modulusPackageName(): string
    {
        return 'inengine/module-skeleton';
    }
}
