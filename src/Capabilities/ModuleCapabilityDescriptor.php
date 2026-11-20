<?php

namespace VendorName\Skeleton\Capabilities;

/**
 * Static capability metadata for the Modulus Capability Registry (readable without booting).
 *
 * Fill provides / requires / peers / events / binds / drivers. Prefer tokens such as
 * `alerts.dispatch` or driver forms `person.user.driver:local`. Also consider Composer
 * `provide` in composer.json for reuse outside InEngine — see docs/STEP-14.md on Modulus.
 *
 * @phpstan-type CapabilityList list<string>
 * @phpstan-type DriverMap array<string, list<string>>
 */
class ModuleCapabilityDescriptor
{
    /**
     * Composer package name this descriptor belongs to.
     */
    public static function packageName(): string
    {
        return ':vendor_slug/:package_slug';
    }

    /**
     * Optional UI display label (e.g. modulus-ui → "Modulus").
     */
    public static function label(): ?string
    {
        return null;
    }

    /**
     * Optional short description for operator UI / inspect.
     */
    public static function description(): ?string
    {
        return null;
    }

    /**
     * Capabilities this module provides (tokens for peers to require).
     *
     * @return CapabilityList
     */
    public static function provides(): array
    {
        return [
            // e.g. 'alerts.dispatch', 'auth.method:local', 'person.user.driver:local',
        ];
    }

    /**
     * Capabilities this module requires from other enabled modules.
     *
     * @return CapabilityList
     */
    public static function requires(): array
    {
        return [
            // e.g. 'identity.demographics',
        ];
    }

    /**
     * Domain / lifecycle event class names this module dispatches or listens for.
     *
     * @return CapabilityList
     */
    public static function events(): array
    {
        return [
            // e.g. \VendorName\Skeleton\Events\SomethingHappened::class,
        ];
    }

    /**
     * Optional peer / companion package names (not hard Composer requires).
     *
     * @return CapabilityList
     */
    public static function peers(): array
    {
        return [
            // e.g. 'inengine/related-feature',
        ];
    }

    /**
     * Interface FQCNs this module documents binding (bindings still happen in the provider).
     *
     * @return CapabilityList
     */
    public static function binds(): array
    {
        return [
            // e.g. \VendorName\Skeleton\Contracts\Something::class,
        ];
    }

    /**
     * Explicit driver map (optional). Tokens in provides with `family:name` are also indexed.
     *
     * @return DriverMap
     */
    public static function drivers(): array
    {
        return [
            // e.g. 'person.user.driver' => ['local'],
        ];
    }

    /**
     * Full descriptor payload for the Capability Registry.
     *
     * @return array{
     *     package: string,
     *     label: string|null,
     *     description: string|null,
     *     provides: CapabilityList,
     *     requires: CapabilityList,
     *     events: CapabilityList,
     *     peers: CapabilityList,
     *     binds: CapabilityList,
     *     drivers: DriverMap
     * }
     */
    public static function toArray(): array
    {
        return [
            'package' => static::packageName(),
            'label' => static::label(),
            'description' => static::description(),
            'provides' => static::provides(),
            'requires' => static::requires(),
            'events' => static::events(),
            'peers' => static::peers(),
            'binds' => static::binds(),
            'drivers' => static::drivers(),
        ];
    }
}
