# Inter-module integration

Use Laravel’s event bus and container — not a custom Modulus plugin API.

## React to Modulus lifecycle

```php
use InEngine\Modulus\Events\ModuleEnabled;
use Illuminate\Support\Facades\Event;

Event::listen(ModuleEnabled::class, function (ModuleEnabled $event): void {
    if ($event->module->package !== 'inengine/other') {
        return;
    }

    // Peer module became available.
});
```

Lifecycle hooks on **this** provider (`activating`, `activated`, …) are for this package’s own side effects. Events are for everyone else. See Modulus `INTEGRATION.md`.

## Domain events (this module)

Put event classes under `src/Events/`. Dispatch with Laravel:

```php
SomethingHappened::dispatch($dto);
// or event(new SomethingHappened($dto));
```

List notable events in `ModuleCapabilityDescriptor::events()` for future inspect tooling.

## Contracts + DTOs

| Folder | Purpose |
|--------|---------|
| `src/Contracts/` | Interfaces this module **provides** for others to consume |
| `src/DataTransferObjects/` | Readonly payloads across module boundaries |

**Provide:** define an interface, bind the implementation in `configurePackage` / provider register when the module is enabled (handshake already gates boot).

**Consume:** `composer require` the providing module (Step 7), type-hint its interface, resolve from the container. Prefer DTOs over `array` payloads.

Example shape (replace with real types):

```php
// src/Contracts/ExampleReader.php
namespace VendorName\Skeleton\Contracts;

interface ExampleReader
{
    public function find(string $id): ?\VendorName\Skeleton\DataTransferObjects\ExampleData;
}
```

```php
// src/DataTransferObjects/ExampleData.php
namespace VendorName\Skeleton\DataTransferObjects;

final readonly class ExampleData
{
    public function __construct(
        public string $id,
        public string $label,
    ) {}
}
```

Bind in the service provider when appropriate:

```php
$this->app->bind(
    \VendorName\Skeleton\Contracts\ExampleReader::class,
    \VendorName\Skeleton\ExampleReader::class,
);
```
