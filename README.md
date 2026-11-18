# :package_description

[![Latest Version on Packagist](https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
[![GitHub Tests Action Status](https://github.com/:vendor_slug/:package_slug/actions/workflows/run-tests.yml/badge.svg)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://github.com/:vendor_slug/:package_slug/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
<!--delete-->
---

**InEngine / Modulus feature-module template** (forked from Spatie `package-skeleton-laravel`).

This repository is a **GitHub template only** — same model as Spatie’s package skeleton. It is **not** published to Packagist and must **not** be `composer require`’d. Create modules with **Use this template**, then run `configure.php`.

1. Click **Use this template** (or clone into `InEngine/Modules/{Feature}`).
2. Read **[TEMPLATE.md](TEMPLATE.md)** for author rules and monorepo layout.
3. Run configure:

```bash
php ./configure.php -n \
  --vendor-name="InEngine" \
  --vendor-username="inengine" \
  --vendor-namespace="InEngine" \
  --package-name="your-feature" \
  --no-ray
```

`php ./configure.php --help` lists all options. After configure, the **new** feature package may be published to Packagist as `inengine/{feature}` — never this template repo.

---
<!--/delete-->

This is where your description should go. Limit it to a paragraph or two.

## Installation

```bash
composer require :vendor_slug/:package_slug
```

On an InEngine host with Modulus: **install ≠ enable**.

1. **Install** (Composer) then publish host resources (config + built assets from `resources/dist`):

```php
Modulus::publish(':vendor_slug/:package_slug');
```

(`inengine/modulus-composer` will call this after require/update. Until then, call it manually.)

2. **Enable** (migrate schema + boot provider — does **not** publish assets or seed):

```bash
php artisan modulus:enable :vendor_slug/:package_slug
```

Enable fails if required **Modulus** modules are disabled, or if any Composer `require` is not installed. Plain (non-Modulus) packages still use **normal Laravel discovery / `vendor:publish`**; optionally reach down from `activating()` when this module must also ensure config, UI **dist → `public/vendor/`**, or migrations — see [resources/DEPENDENCIES.md](resources/DEPENDENCIES.md).

### Frontend assets (`resources/dist`)

Built CSS/JS belong in `resources/dist/` (see [resources/ASSETS.md](resources/ASSETS.md)).  
`configure.php` creates `resources/dist/css/:package_slug.css` and `resources/dist/js/:package_slug.js` stubs and enables Spatie `hasAssets()`.

After `Modulus::publish()`, assets land at `public/vendor/:package_slug/`.

Point Vite/Mix **outDir** at `resources/dist` — do not rely on enable to copy assets.

### Config / views (optional host overrides)

Runtime still merges config and loads views from the package on enable. To customize on the host:

```bash
php artisan vendor:publish --tag=":package_slug-config"
php artisan vendor:publish --tag=":package_slug-views"
```

### Inter-module integration

Lifecycle events, domain events, contracts, and DTOs: see [resources/INTEGRATION.md](resources/INTEGRATION.md). Prefer Laravel’s bus + container; optional folders: `src/Contracts`, `src/DataTransferObjects`, `src/Events`.

### Seeders (explicit only)

```php
Modulus::seed(':vendor_slug/:package_slug', confirmed: true);
```

Never seeded on enable/install. Skeleton ships `database/seeders/ModuleSeeder` with confirmation required.

## Usage

```php
$:variable = new VendorName\Skeleton\Skeleton();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
