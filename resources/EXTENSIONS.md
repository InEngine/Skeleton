# Extending another Modulus module (macros / relations)

Companions must **not** edit the hub module’s model source or force traits onto it.

Use Laravel runtime hooks **after** {@see \InEngine\Modulus\Support\ModuleExtensionGate} says the hub is ready:

```php
use InEngine\Modulus\Support\ModuleExtensionGate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use InEngine\Modulus\Events\ModuleEnabled;

public function packageRegistered(): void
{
    parent::packageRegistered();

    $attach = function (): void {
        app(ModuleExtensionGate::class)->whenReady(
            callback: function (): void {
                $userModel = config('user.model');
                if (! is_string($userModel) || ! class_exists($userModel)) {
                    return;
                }

                $userModel::resolveRelationUsing('localCredential', function (Model $user) {
                    return $user->hasOne(LocalCredential::class, 'user_id');
                });

                // Non-relation helpers:
                // $userModel::macro('hasLocalPassword', fn () => …);
            },
            tokens: ['identity.user', 'identity.user.config'],
            packages: ['inengine/user'],
            configKeys: ['user.model'],
        );
    };

    Event::listen(ModuleEnabled::class, function (ModuleEnabled $event) use ($attach): void {
        if (in_array($event->module->package, ['inengine/user', $this->modulusPackageName()], true)) {
            $attach();
        }
    });

    $this->app->booted($attach);
}
```

Declare matching `requires` in `Capabilities\ModuleCapabilityDescriptor` so enable is blocked until those tokens exist.

Library modules (`kind: library`) default to enabled and do not block feature enable.
