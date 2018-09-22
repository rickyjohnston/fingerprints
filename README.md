# Fingerprints

Keep track of which Admins touch your Laravel Eloquent models.

## Usage

This package provides a new abstract class for your model to extend. Swap out `Model` for `TrackableModel`.

```php
<?php

namespace App;

use RickyJohnston\Fingerprints\TrackableModel;

class ExampleModel extends TrackableModel
{
    // ...
}
```

By doing this, your model will automatically dispatch Fingerprints' custom Events on `create` and `update`. Additionally, a `creator()` and `updater()` relationship will be assigned to the model (both referencing the App\User model).

Since this package is using events and listeners, head to your `EventServiceProvider` and add these new objects to the `$listen` array.

```php
//..
use RickyJohnston\Fingerprints\Events\ModelCreated;
use RickyJohnston\Fingerprints\Events\ModelUpdated;
use RickyJohnston\Fingerprints\Listeners\AddCreatorToModel;
use RickyJohnston\Fingerprints\Listeners\AddUpdaterToModel;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ModelCreated::class => [
            AddCreatorToModel::class,
        ],
        ModelUpdated::class => [
            AddUpdaterToModel::class,
        ],
        // ...
    ];
}
```

Finally, Fingerprints registers a macro on the Blueprint class, allowing you to use a new method inside your migrations. Add the `fingerprints()` method to your model Migrations to create the `created_by` and `updated_by` columns:

```php
Schema::create('posts', function (Blueprint $table) {
    $table->increments('id');
    $table->text('message');
    $table->fingerprints();
    $table->timestamps();
});
```

For the `down()` method inside migrations, `dropFingerprints()` also exists.
