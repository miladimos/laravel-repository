<?php

namespace Miladimos\Repository\Providers;

use Illuminate\Support\ServiceProvider;
use Miladimos\Repository\Console\Commands\MakeRepositoryCommand;
use Miladimos\Repository\Repository;

class RepositoryServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/config.php", 'repository');

        $this->registerFacades();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->registerPublishes();

            $this->registerCommands();

        }
    }

    private function registerFacades()
    {
        $this->app->bind('repository', function ($app) {
            return new Repository();
        });
    }

    private function registerPublishes()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('repository.php')
        ], 'repository-config');
    }

    public function registerCommands()
    {
        $this->commands([
            MakeRepositoryCommand::class,
        ]);
    }
}
