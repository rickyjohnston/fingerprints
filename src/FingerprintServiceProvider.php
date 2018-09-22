<?php

namespace RickyJohnston\Fingerprints;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class FingerprintServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addMigrationMacros();

        $this->publishes([
            __DIR__ . '/../config/fingerprints.php' => config_path('fingerprints.php'),
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/fingerprints.php', 'fingerprints'
        );
    }

    /**
     * Add package Migration Macros
     *
     * @return void
     */
    public function addMigrationMacros()
    {
        Blueprint::macro('fingerprints', function () {
            $this->unsignedInteger('created_by')->nullable();
            $this->unsignedInteger('updated_by')->nullable();
        });

        Blueprint::macro('dropFingerprints', function () {
            $this->dropColumn(['created_by', 'updated_by']);
        });
    }
}
