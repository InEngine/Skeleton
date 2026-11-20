<?php

/**
 * Architecture rules: forbids debugging helpers (`dd`, `dump`, `ray`) in the codebase.
 */

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();
