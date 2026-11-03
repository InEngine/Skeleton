<?php

namespace VendorName\Skeleton\Capabilities;

/**
 * Static capability metadata for modulus-inspect (and future compat tooling).
 *
 * Keep this readable without booting the module: no container, no facades,
 * no side effects. Authors fill in provides / requires / events / peers.
 *
 * @phpstan-type CapabilityList list<string>
 */
class ModuleCapabilityDescriptor
{
    /**
     * Composer package name this descriptor belongs to.
     */
    public static function packageName(): string
    {
        return 'inengine/module-skeleton';
    }

    /**
     * Capabilities this module provides (tokens for peers to require).
     *
     * @return CapabilityList
     */
    public static function provides(): array
    {
        return [
            // e.g. 'alerts.dispatch',
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
            // e.g. 'users.auth',
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
     * Full descriptor payload for inspect tooling.
     *
     * @return array{
     *     package: string,
     *     provides: CapabilityList,
     *     requires: CapabilityList,
     *     events: CapabilityList,
     *     peers: CapabilityList
     * }
     */
    public static function toArray(): array
    {
        return [
            'package' => static::packageName(),
            'provides' => static::provides(),
            'requires' => static::requires(),
            'events' => static::events(),
            'peers' => static::peers(),
        ];
    }
}
