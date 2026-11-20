<?php

/**
 * Unit coverage for {@see ModuleCapabilityDescriptor}.
 */

use VendorName\Skeleton\Capabilities\ModuleCapabilityDescriptor;

it('exposes a static capability payload for inspect tooling', function () {
    $payload = ModuleCapabilityDescriptor::toArray();

    expect($payload)
        ->toHaveKeys(['package', 'provides', 'requires', 'events', 'peers'])
        ->and($payload['package'])->toBe(':vendor_slug/:package_slug')
        ->and($payload['provides'])->toBeArray()
        ->and($payload['requires'])->toBeArray()
        ->and($payload['events'])->toBeArray()
        ->and($payload['peers'])->toBeArray();
});
