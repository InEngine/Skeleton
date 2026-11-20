<?php

namespace VendorName\Skeleton\Commands;

use Illuminate\Console\Command;
use VendorName\Skeleton\SkeletonServiceProvider;

/**
 * Placeholder Artisan command for the Modulus feature-module template.
 *
 * Registered in {@see SkeletonServiceProvider::configurePackage()}.
 */
class SkeletonCommand extends Command
{
    public $signature = 'skeleton';

    public $description = 'My command';

    /** Execute the console command. */
    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
