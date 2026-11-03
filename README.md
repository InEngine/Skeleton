# :package_description

[![Latest Version on Packagist](https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
[![GitHub Tests Action Status](https://github.com/:vendor_slug/:package_slug/actions/workflows/run-tests.yml/badge.svg)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://github.com/:vendor_slug/:package_slug/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
<!--delete-->
---

**InEngine / Modulus feature-module template** (forked from Spatie `package-skeleton-laravel`).

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

`php ./configure.php --help` lists all options.

---
<!--/delete-->

This is where your description should go. Limit it to a paragraph or two.

## Installation

```bash
composer require :vendor_slug/:package_slug
```

On an InEngine host with Modulus, the package is **discovered but disabled** until:

```bash
php artisan modulus:enable :vendor_slug/:package_slug
```

Publish and run migrations when enabling / upgrading (host or module hooks — see Modulus docs):

```bash
php artisan vendor:publish --tag=":package_slug-migrations"
php artisan migrate
```

Publish the config file with:

```bash
php artisan vendor:publish --tag=":package_slug-config"
```

```php
return [

];
```

Optionally publish views:

```bash
php artisan vendor:publish --tag=":package_slug-views"
```

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
