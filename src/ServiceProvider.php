<?php

namespace NogorSolutionsLTD\Hver;

use Illuminate\Support\Str;
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
        # Load all helper functions.
        foreach ( scandir( __DIR__ . DIRECTORY_SEPARATOR . 'helpers' ) as $helperFile ) {
            $path = sprintf(
                '%s%s%s%s%s',
                __DIR__,
                DIRECTORY_SEPARATOR,
                'helpers',
                DIRECTORY_SEPARATOR,
                $helperFile
            );

            if ( !is_file( $path ) ) {
                continue;
            }

            $function = Str::before( $helperFile, '.php' );

            if ( function_exists( $function ) ) {
                continue;
            }

            require_once $path;
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                \NogorSolutionsLTD\Hver\Console\Commands\EnvironmentCommand::class,
                \NogorSolutionsLTD\Hver\Console\Commands\SetProdCommand::class,
                \NogorSolutionsLTD\Hver\Console\Commands\SetWebPackProdCommand::class,
                \NogorSolutionsLTD\Hver\Console\Commands\SetWebPackLocalCommand::class,
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
