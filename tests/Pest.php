<?php

/**
 * Pest bootstrap: binds {@see \VendorName\Skeleton\Tests\TestCase} to every test in this directory.
 */

use VendorName\Skeleton\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);
