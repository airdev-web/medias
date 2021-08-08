<?php

namespace Airdev\Medias;

use Airdev\Medias\App\Nova\AirdevMediasResource;
use Airdev\Medias\App\Views\Components\Picture;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class AirdevMediasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            AirdevMediasResource::class,
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'airdev-medias');
        Blade::componentNamespace('Airdev\\Medias\\App\\Views\\Components', 'airdev');
    }
}
