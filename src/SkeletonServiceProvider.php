<?php

namespace VendorName\Skeleton;

use Illuminate\Support\Facades\File;
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
         *
         * Non-Modulus Composer deps still use normal Laravel discovery/publish.
         * Optionally reach down from bootstrapNonModulusDependencies() when this
         * module must also ensure config, public/vendor dist, or migrations —
         * see resources/DEPENDENCIES.md.
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

    /**
     * {@inheritdoc}
     *
     * Runs before this module’s migrations on enable. Optional reach-down for
     * non-Modulus deps (normal Laravel discovery still applies). See
     * resources/DEPENDENCIES.md.
     */
    public function activating(string $package): void
    {
        $this->bootstrapNonModulusDependencies();
    }

    /**
     * Optional host bootstrap for plain Composer packages this module requires.
     *
     * Default path: those packages discover and boot via Laravel as usual
     * (providers, publishes tags, vendor:publish). Leave this empty unless
     * this module must also ensure config copies, public/vendor UI dist, or
     * migrations at enable time. Keep disable/uninstall non-destructive.
     */
    protected function bootstrapNonModulusDependencies(): void
    {
        // Prefer the dependency’s own ServiceProvider + vendor:publish tags.
        // Uncomment only when this module must also force host-side setup:
        //
        // $this->publishDependencyConfig('vendor/package', 'config/package.php');
        // $this->publishDependencyDistAssets('vendor/package');
        // $this->callSilent('vendor:publish', [
        //     '--provider' => \Vendor\Package\PackageServiceProvider::class,
        //     '--tag' => 'package-config',
        // ]);
        // $this->loadMigrationsFrom(
        //     base_path('vendor/vendor/package/database/migrations')
        // );
    }

    /**
     * Optional: copy a dependency config file into the host config/ directory.
     *
     * Prefer the package’s normal `publishes()` / `vendor:publish` when enough.
     *
     * @param  string  $composerPackage  e.g. spatie/laravel-permission
     * @param  string  $relativeConfigFile  Path under the package root, e.g. config/permission.php
     */
    protected function publishDependencyConfig(
        string $composerPackage,
        string $relativeConfigFile,
        bool $force = false,
    ): void {
        $source = base_path('vendor/'.$composerPackage.'/'.$relativeConfigFile);

        if (! File::isFile($source)) {
            return;
        }

        $destination = config_path(basename($relativeConfigFile));

        if (! $force && File::exists($destination)) {
            return;
        }

        File::ensureDirectoryExists(dirname($destination));
        File::copy($source, $destination);
    }

    /**
     * Optional: copy a dependency’s built UI tree into public/vendor/{short-name}.
     *
     * Prefer the package’s own asset publish tags when enough. Defaults to
     * Spatie/Modulus-style `resources/dist` → `public/vendor/{name}`.
     * Pass $relativeDistDirectory when the package uses another layout.
     *
     * @param  string  $composerPackage  e.g. vendor/ui-kit
     * @param  string|null  $publicVendorName  Defaults to the package name after the /
     */
    protected function publishDependencyDistAssets(
        string $composerPackage,
        ?string $publicVendorName = null,
        string $relativeDistDirectory = 'resources/dist',
        bool $force = true,
    ): void {
        $source = base_path('vendor/'.$composerPackage.'/'.$relativeDistDirectory);

        if (! File::isDirectory($source)) {
            return;
        }

        $shortName = $publicVendorName ?? basename(str_replace('\\', '/', $composerPackage));
        $destination = public_path('vendor/'.$shortName);

        if ($force && File::isDirectory($destination)) {
            File::deleteDirectory($destination);
        }

        if (! $force && File::exists($destination)) {
            return;
        }

        File::ensureDirectoryExists(dirname($destination));
        File::copyDirectory($source, $destination);
    }
}
