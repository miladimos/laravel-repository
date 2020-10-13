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

        $this->app->bind('repository', function($app) {
            return new Repository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('repository.php')
            ],'repository-config');

            $this->commands([
                MakeRepositoryCommand::class,
            ]);

        }
    }

}
