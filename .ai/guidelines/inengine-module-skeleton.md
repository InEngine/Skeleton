# InEngine module-skeleton (template repo)

This repository is a **GitHub template only** — never `composer require` it; never publish it to Packagist. Generate feature modules with configure, then work in the new package.

## Commands (template maintenance)

- `./scripts/template-dev-install.sh` then `vendor/bin/pest`
- `vendor/bin/phpstan analyse`
- `vendor/bin/pint`

## Agent rules

- Follow `resources/boost/guidelines/core.blade.php` and `TEMPLATE.md`.
- Keep placeholders (`:vendor_slug`, `VendorName\Skeleton`) until `configure.php` runs.
- When changing lifecycle/publish/seed/deps/integration conventions, update `README.md`, `TEMPLATE.md`, `resources/*.md`, and `CHANGELOG.md`.
- Prefer PHPDoc over inline comments.
- Feature package names must be `inengine/{feature}`, never `inengine/modulus-*`.
