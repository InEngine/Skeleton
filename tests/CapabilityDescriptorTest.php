<?php

/**
 * Unit coverage for {@see ModuleCapabilityDescriptor}.
 */

use VendorName\Skeleton\Capabilities\ModuleCapabilityDescriptor;

it('exposes a static capability payload for the Modulus Capability Registry', function () {
    $payload = ModuleCapabilityDescriptor::toArray();

    expect($payload)
        ->toHaveKeys(['package', 'label', 'description', 'provides', 'requires', 'events', 'peers', 'binds', 'drivers'])
        ->and($payload['package'])->toBe(':vendor_slug/:package_slug')
        ->and($payload['provides'])->toBeArray()
        ->and($payload['requires'])->toBeArray()
        ->and($payload['events'])->toBeArray()
        ->and($payload['peers'])->toBeArray()
        ->and($payload['binds'])->toBeArray()
        ->and($payload['drivers'])->toBeArray();
});
