<?php

/**
 * Coverage for {@see \VendorName\Skeleton\SkeletonServiceProvider} dependency config and dist asset publishing.
 */

use Illuminate\Support\Facades\File;
use VendorName\Skeleton\SkeletonServiceProvider;

it('copies dependency config into the host config path', function () {
    $vendorRoot = base_path('vendor/acme/demo-pkg');
    $source = $vendorRoot.'/config/demo.php';
    File::ensureDirectoryExists(dirname($source));
    File::put($source, "<?php\n\nreturn ['ok' => true];\n");

    $destination = config_path('demo.php');
    if (File::exists($destination)) {
        File::delete($destination);
    }

    try {
        $provider = app()->getProvider(SkeletonServiceProvider::class);
        $method = new ReflectionMethod($provider, 'publishDependencyConfig');
        $method->setAccessible(true);
        $method->invoke($provider, 'acme/demo-pkg', 'config/demo.php');

        expect(File::isFile($destination))->toBeTrue()
            ->and(File::get($destination))->toContain("'ok' => true");
    } finally {
        File::delete($destination);
        File::deleteDirectory($vendorRoot);
    }
});

it('copies dependency dist assets into public/vendor', function () {
    $vendorRoot = base_path('vendor/acme/demo-pkg');
    $source = $vendorRoot.'/resources/dist/css/app.css';
    File::ensureDirectoryExists(dirname($source));
    File::put($source, '/* demo */');

    $destination = public_path('vendor/demo-pkg');
    if (File::isDirectory($destination)) {
        File::deleteDirectory($destination);
    }

    try {
        $provider = app()->getProvider(SkeletonServiceProvider::class);
        $method = new ReflectionMethod($provider, 'publishDependencyDistAssets');
        $method->setAccessible(true);
        $method->invoke($provider, 'acme/demo-pkg');

        expect(File::isFile($destination.'/css/app.css'))->toBeTrue()
            ->and(File::get($destination.'/css/app.css'))->toBe('/* demo */');
    } finally {
        File::deleteDirectory($destination);
        File::deleteDirectory($vendorRoot);
    }
});
