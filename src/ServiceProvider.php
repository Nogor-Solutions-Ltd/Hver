<?php

namespace NogorSolutionsLTD\Hver;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
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
        //
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                // ...
            ]);
        }

        
        $this->publishes([
            __DIR__.'/../config/hver.php' => config_path('hver.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'hver');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hver');

    }
}
