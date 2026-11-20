<?php

/**
 * Coverage for the Modulus handshake implemented by {@see \VendorName\Skeleton\SkeletonServiceProvider}.
 */

use InEngine\Modulus\ModuleServiceProvider;
use VendorName\Skeleton\SkeletonServiceProvider;

it('extends the Modulus module service provider handshake', function () {
    expect(is_subclass_of(SkeletonServiceProvider::class, ModuleServiceProvider::class))
        ->toBeTrue();
});

it('declares the composer package name for Modulus registration', function () {
    $provider = app()->getProvider(SkeletonServiceProvider::class);
    $method = new ReflectionMethod($provider, 'modulusPackageName');

    expect($method->invoke($provider))->toBe(':vendor_slug/:package_slug');
});
