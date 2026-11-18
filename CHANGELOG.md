# Changelog

All notable changes to `module-skeleton` will be documented in this file.

## Unreleased

### Step 7 — Dependencies + reach-down scaffolding

- `resources/DEPENDENCIES.md`: Composer `require` graph; plain deps keep normal Laravel discovery/publish; optional module reach-down for config + `resources/dist` → `public/vendor` + migrations
- Provider `activating()` → `bootstrapNonModulusDependencies()` stub (empty by default)
- Optional helpers: `publishDependencyConfig()`, `publishDependencyDistAssets()`
- README / TEMPLATE note enable dep checks and optional reach-down

### Step 6 alignment (Modulus lifecycle / publish / seed)

- Idempotent migration stub (`Schema::hasTable` + `down()` via `dropIfExists`)
- `database/seeders/ModuleSeeder` with `requiresConfirmation(): true`; provider `modulusSeederClass()`; Composer PSR-4 for Seeders
- `resources/dist` CSS/JS stubs + `resources/ASSETS.md`; `configure.php` renames stubs and runs `ensureDistAssets()`
- Provider enables Spatie `hasAssets()`
- README / TEMPLATE document install → `Modulus::publish()` → enable → confirmed seed

### Earlier

- Fork Spatie `package-skeleton-laravel` as a **GitHub template** (not a Packagist package)
- Default provider extends `InEngine\Modulus\ModuleServiceProvider`
- Capability descriptor stub for `modulus-inspect`
- PHP `^8.5`, Laravel 12/13, Pint / Pest / PHPStan
- Path repository to sibling `../Modulus` for monorepo development of generated modules
