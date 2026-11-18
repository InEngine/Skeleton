<?php

namespace VendorName\Skeleton\Database\Seeders;

use InEngine\Modulus\Contracts\ModuleSeeder as ModuleSeederContract;

/**
 * Default module seeder shipped by the InEngine module skeleton.
 *
 * Run only via:
 *
 *     Modulus::seed('inengine/{feature}', confirmed: true);
 *
 * Never on enable/install. requiresConfirmation() is always true so accidental
 * seeding is rejected. Keep run() idempotent (firstOrCreate / upsert) because
 * Modulus disable/uninstall leave tables and data in place.
 *
 * Future `php artisan modulus:seed {module}` will prompt, then call seed with
 * confirmation.
 */
class ModuleSeeder implements ModuleSeederContract
{
    /**
     * {@inheritdoc}
     */
    public function requiresConfirmation(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * Replace the example with real seed data. Prefer idempotent writes.
     */
    public function run(): void
    {
        // Example (uncomment and adapt when the module has models/tables):
        //
        // \VendorName\Skeleton\Models\YourModel::query()->firstOrCreate(
        //     ['slug' => 'default'],
        //     ['name' => 'Default'],
        // );
    }
}
