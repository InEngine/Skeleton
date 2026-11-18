# InEngine module skeleton

Customized Spatie `package-skeleton-laravel` for **Modulus-compatible** feature modules.

**Distribution:** GitHub **template repository** only (like Spatie’s skeleton).  
**Not** a Packagist package — never publish this repo; never `composer require inengine/module-skeleton`.

**GitHub:** https://github.com/InEngine/module-skeleton  
**Plan:** Documentation `Plan and Design.md` — Step 4b

## Create a new module

1. Use this repo as a GitHub template (or clone and rename under `InEngine/Modules/{Feature}`).
2. Run configure (unattended example):

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

3. Confirm the provider extends `InEngine\Modulus\ModuleServiceProvider` and `modulusPackageName()` returns `inengine/{feature}`.
4. Fill `src/Capabilities/ModuleCapabilityDescriptor.php` for `modulus-inspect`.

`configure.php` deletes itself and this file when configuration finishes. The **resulting** feature package is what you version, require, and (optionally) publish to Packagist.

## Author rules (encoded here)

1. Package name: `inengine/{feature}` — never `inengine/modulus-*` (reserved for runtime extensions).
2. Extend `ModuleServiceProvider`; declare `modulusPackageName()`.
3. Discovery only via `extra.laravel.providers` / aliases.
4. Install ≠ enable; default disabled until `modulus:enable`.
5. SemVer, Pint, Pest, PHPStan; CLI/API first.
6. Migrations on enable/upgrade; disable/uninstall non-destructive by default.
7. Guard creates with `Schema::hasTable` — tables may already exist after a prior install/uninstall.
8. Ship Spatie layouts for install-time `Modulus::publish()` (modulus-composer): `config/`, `resources/dist` → `public/vendor/{feature}`. Views/lang load from the package unless the host opts into override publish.
9. Keep `database/seeders/ModuleSeeder.php` and `modulusSeederClass()`. Seed only with `Modulus::seed(..., confirmed: true)` — never on enable.
10. `configure.php` creates `resources/dist/css|{js}/{feature}.*` stubs, enables `hasAssets()`, and leaves `resources/ASSETS.md`. Put bundler output in `dist` before publish.
11. Composer `require` is the hard dependency graph (Step 7). Modulus modules among requires must be enabled before this module can enable; non-Modulus packages need only be installed and keep **normal Laravel discovery / publish**. Optionally **reach down** from `bootstrapNonModulusDependencies()` when this module must also ensure config, UI **`resources/dist` → `public/vendor/{name}`**, or migrations — see `resources/DEPENDENCIES.md`.
12. Cross-module integration (Step 8): listen to Modulus lifecycle events; dispatch domain events normally; publish contracts + DTOs and bind in the container — see `resources/INTEGRATION.md` (`src/Contracts`, `src/DataTransferObjects`, `src/Events`).
13. AI agents: keep `AGENTS.md`, `.ai/guidelines/`, and `resources/boost/guidelines` aligned with author rules (Laravel Boost Step 8b).

## Assets after configure

```text
resources/
  ASSETS.md          # author docs (not published to public/)
  dist/
    css/{feature}.css
    js/{feature}.js
  views/             # Blade — loaded from package on enable
```

Build into `dist`, then `Modulus::publish()` on install.

## Working on the template itself

`composer.json` keeps Spatie-style placeholders (`:vendor_slug/:package_slug`) so Composer will not treat this tree as a real package until configure runs. For local template maintenance:

```bash
chmod +x scripts/template-dev-install.sh
./scripts/template-dev-install.sh
vendor/bin/pest
```

The script temporarily substitutes a fixture name, installs, then restores `composer.json` via `git checkout`.

After Modulus is on Packagist, configured feature modules should depend on a tagged `inengine/modulus` constraint and may drop the path repository.

## Quality

- PHP `^8.5`, Laravel 12/13
- Pint, Pest, PHPStan / Larastan
- Conventional Commits; SemVer releases (on **generated** modules, not this template)
