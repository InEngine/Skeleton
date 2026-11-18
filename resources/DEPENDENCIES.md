# Composer dependencies (Modulus Step 7)

Hard dependencies live in this package’s `composer.json` **`require`**. Modulus reads that graph on enable / disable / forget.

| Dependency kind | What Modulus checks | How it loads on the host |
|-----------------|---------------------|---------------------------|
| **Modulus module** | Installed **and** enabled | Modulus discovery gate + handshake; enable that module first |
| **Non-Modulus Composer package** | Installed only | **Normal Laravel package discovery** (providers, aliases, Spatie publish tags) — Modulus does **not** filter these under default `discovery.scope = modules` |

Capability-descriptor `requires` (tokens) are for `modulus-inspect` later — not the enable/disable graph.

## Default: normal Composer / Laravel package behavior

Plain packages (Livewire, Spatie libs, etc.) keep working the usual way:

1. Composer installs them as your `require`s.
2. Laravel `package:discover` registers their `extra.laravel.providers`.
3. Their service providers boot with the app (config merge, routes, views, `publishes()` tags).
4. Operators can still run `php artisan vendor:publish --tag=…` when the package documents it.

You do **not** need to re-implement that from this module. Prefer the dependency’s own provider and publish tags whenever they are enough.

## Optional: reach-down from this module

Use lifecycle helpers only when **this feature** must ensure host-side setup that discovery alone does not guarantee (or that must run at **this module’s enable** time), for example:

- Copy config or built UI into the host before your module’s routes/views need them
- Force-refresh `public/vendor/{name}` assets on activate
- Load a dependency’s migrations in lockstep with your enable path
- A dependency that ships assets/config but does not auto-publish them

Prefer **`activating()`** (before this module’s migrations) or **`activated()`** (after enable + discovery sync). Keep disable / uninstall **non-destructive** — do not delete published config, wipe `public/vendor/…`, or drop the dependency’s tables when this module is turned off.

Skeleton entry point: `bootstrapNonModulusDependencies()` (called from `activating()`). Leave it empty when normal discovery is enough.

### Optional helper examples

```php
protected function bootstrapNonModulusDependencies(): void
{
    // Only when you need host copies beyond the dependency’s own provider:

    // Config → config/ (skip existing unless force: true)
    // $this->publishDependencyConfig('spatie/laravel-permission', 'config/permission.php');

    // Built UI → public/vendor/{short-name}/ (force refresh by default)
    // $this->publishDependencyDistAssets('vendor/ui-kit');

    // Or the package’s own tags (normal Laravel way, invoked from here if useful):
    // $this->callSilent('vendor:publish', [
    //     '--provider' => \Spatie\Permission\PermissionServiceProvider::class,
    //     '--tag' => 'permission-config',
    // ]);

    // Migrations in lockstep with this module’s enable:
    // $this->loadMigrationsFrom(
    //     base_path('vendor/spatie/laravel-permission/database/migrations')
    // );
}
```

Only reach down for packages listed in **your** `composer.json` `require`. Adjust paths when a dependency does not use Spatie-style `config/` + `resources/dist` layouts.
