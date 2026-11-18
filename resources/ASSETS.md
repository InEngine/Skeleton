# Frontend assets for Modulus modules

This package follows the Spatie / Modulus convention for browser assets.

## Layout

| Path | Purpose |
|------|---------|
| `resources/dist/` | **Built** CSS/JS (and fonts, etc.) ready for the host |
| `resources/dist/css/` | Stylesheets published to the host |
| `resources/dist/js/` | Scripts published to the host |
| `resources/views/` | Blade views — loaded from the package on enable (publish optional) |
| `resources/js/`, `resources/css/` | Optional **source** for your bundler (not published by default) |

## When assets are published

**Install / Composer update** (via `inengine/modulus-composer` or manually):

```php
Modulus::publish('inengine/:package_slug');
```

That copies `resources/dist` → `public/vendor/:package_slug`.

**Enable** does **not** publish assets. Enable only migrates schema and boots the provider.

Flow:

```text
composer require → Modulus::publish() → discover (disabled) → modulus:enable (migrate + boot)
```

## Building into `dist`

Point your bundler output at `resources/dist` (not `public/` in the host). Examples:

- Vite `build.outDir` → `resources/dist`
- Mix `publicPath` / output → `resources/dist`

Commit built assets when the module ships without a host-side build step, or document that hosts must run this package’s build before `Modulus::publish()`.

## UI components

| Kind | Approach |
|------|----------|
| Livewire / Blade PHP components | Ship in the package; register on enable — **no** publish |
| Blade views | `loadViewsFrom` vendor; override publish is opt-in |
| Inertia pages | Prefer package resolution; opt-in host publish |
| Operator Modulus chrome | Use `inengine/modulus-ui`, not this feature module |

## Seeders (not assets)

Data seeders are separate: `Modulus::seed('inengine/:package_slug', confirmed: true)` only — never on enable/install. See `database/seeders/ModuleSeeder.php`.
