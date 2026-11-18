# InEngine module-skeleton

GitHub **template** for Modulus-compatible feature modules (not a Packagist package).

## Create a module

```bash
php ./configure.php -n \
  --vendor-name="InEngine" \
  --vendor-username="inengine" \
  --vendor-namespace="InEngine" \
  --package-name="your-feature" \
  --no-ray
```

## Template maintenance tests

- `./scripts/template-dev-install.sh`
- `vendor/bin/pest`
- `vendor/bin/phpstan analyse`
- `vendor/bin/pint --dirty`

## Docs

- `TEMPLATE.md`, `README.md`
- `resources/ASSETS.md`, `resources/DEPENDENCIES.md`, `resources/INTEGRATION.md`
- Boost guidelines: `resources/boost/guidelines/core.blade.php`

<laravel-boost-guidelines>
=== foundation rules ===

# Template agent rules

- This repo is a template — do not treat it as an installable Composer package.
- Follow sibling file conventions; prefer PHPDoc over inline comments.
- Update CHANGELOG / TEMPLATE / resources docs when authoring conventions change.
- Be concise in replies.

=== inengine/module-skeleton rules ===

# Feature module conventions

- Extend `ModuleServiceProvider`; `modulusPackageName()` → `inengine/{feature}`.
- Install ≠ enable ≠ seed. Publish on install; migrate on enable; seed only with confirmation.
- Composer `require` deps: Modulus modules must be enabled; plain packages stay on normal Laravel discovery. Optional reach-down helpers for config / `public/vendor` dist.
- Contracts + DTOs + domain events via Laravel container/bus (`resources/INTEGRATION.md`).
- Idempotent migrations (`Schema::hasTable`). Non-destructive disable/uninstall.
- Never use `inengine/modulus-*` for feature modules.

</laravel-boost-guidelines>
