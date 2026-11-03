# InEngine module skeleton

Customized Spatie `package-skeleton-laravel` for **Modulus-compatible** feature modules.

**GitHub:** https://github.com/InEngine/module-skeleton  
**Plan:** Documentation `Plan and Design.md` — Step 4b

## Create a new module

1. Use this repo as a GitHub template (or clone and rename).
2. Place the package under `InEngine/Modules/{Feature}` next to Modulus when developing in the monorepo.
3. Run configure (unattended example):

```bash
php ./configure.php -n \
  --vendor-name="InEngine" \
  --vendor-username="inengine" \
  --vendor-namespace="InEngine" \
  --package-name="alert" \
  --author-name="James Johnson" \
  --author-email="james.johnson@excellentingenuity.com" \
  --author-username="excellentingenuity" \
  --no-ray \
  --description="In App Alert Notifications for Laravel/InEngine Applications"
```

4. Confirm the provider extends `InEngine\Modulus\ModuleServiceProvider` and `modulusPackageName()` returns `inengine/{feature}`.
5. Fill `src/Capabilities/ModuleCapabilityDescriptor.php` for `modulus-inspect`.

`configure.php` deletes itself and this file when configuration finishes.

## Author rules (encoded here)

1. Package name: `inengine/{feature}` — never `inengine/modulus-*` (reserved for runtime extensions).
2. Extend `ModuleServiceProvider`; declare `modulusPackageName()`.
3. Discovery only via `extra.laravel.providers` / aliases.
4. Install ≠ enable; default disabled until `modulus:enable`.
5. SemVer, Pint, Pest, PHPStan; CLI/API first.
6. Migrations on enable/upgrade; disable/uninstall non-destructive by default.

## Local Modulus dependency

`composer.json` uses a **path** repository `../Modulus` for the InEngine modules layout. GitHub Actions checks out Modulus as a sibling. After Modulus is on Packagist, switch `require` to a tagged constraint and drop the path repo for published feature modules.

## Quality

- PHP `^8.5`, Laravel 12/13
- Pint, Pest, PHPStan / Larastan
- Conventional Commits; SemVer releases
