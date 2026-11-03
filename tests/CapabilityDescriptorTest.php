<?php

use VendorName\Skeleton\Capabilities\ModuleCapabilityDescriptor;

it('exposes a static capability payload for inspect tooling', function () {
    $payload = ModuleCapabilityDescriptor::toArray();

    expect($payload)
        ->toHaveKeys(['package', 'provides', 'requires', 'events', 'peers'])
        ->and($payload['package'])->toBe('inengine/module-skeleton')
        ->and($payload['provides'])->toBeArray()
        ->and($payload['requires'])->toBeArray()
        ->and($payload['events'])->toBeArray()
        ->and($payload['peers'])->toBeArray();
});
