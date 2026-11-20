<?php

namespace VendorName\Skeleton\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \VendorName\Skeleton\Skeleton
 */
class Skeleton extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return \VendorName\Skeleton\Skeleton::class;
    }
}
