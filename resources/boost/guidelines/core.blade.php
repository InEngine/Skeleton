## InEngine module-skeleton / feature modules

Scaffold Modulus-compatible feature modules from this GitHub **template** (not a Packagist package). Generated packages are named `inengine/{feature}` and depend on `inengine/modulus`.

### Required shape

- Extend `InEngine\Modulus\ModuleServiceProvider`; implement `modulusPackageName()`.
- Discovery only via `extra.laravel.providers`.
- Spatie layouts: `config/`, `resources/dist` (UI), `database/migrations` (idempotent `Schema::hasTable`), `database/seeders/ModuleSeeder` with `requiresConfirmation(): true`.
- Capability stub: `src/Capabilities/ModuleCapabilityDescriptor.php` for future `modulus-inspect`.

### Install ≠ enable

- Host: Composer require → `Modulus::publish()` → `Modulus::enable()` → optional confirmed `Modulus::seed()`.
- Enable does not publish assets or seed.
- See `resources/ASSETS.md`, `resources/DEPENDENCIES.md`, `resources/INTEGRATION.md`.

### Dependencies

- Composer `require` is the hard graph (Modulus Step 7).
- Required Modulus modules must be enabled first; non-Modulus packages need only be installed and keep normal Laravel discovery / `vendor:publish`.
- Optional: `bootstrapNonModulusDependencies()` / `publishDependencyConfig()` / `publishDependencyDistAssets()` when this module must also ensure host config or `public/vendor` UI at enable time.

### Integration

- Listen to Modulus lifecycle events; dispatch domain events the Laravel way.
- Put interfaces in `src/Contracts/`, DTOs in `src/DataTransferObjects/`, domain events in `src/Events/`.
- Bind implementations in the provider when enabled. No custom plugin registry.

### Quality

- PHP `^8.5`, Laravel 12/13, Pint, Pest, PHPStan.
- Prefer PHPDoc over inline comments.
- Never name a feature module `inengine/modulus-*`.
