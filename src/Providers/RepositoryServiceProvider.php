<?php

namespace Miladimos\Repository\Providers;

use Illuminate\Support\ServiceProvider;
use Miladimos\Repository\Console\Commands\InstallPackageCommand;
use Miladimos\Repository\Console\Commands\MakeRepositoryCommand;
use Miladimos\Repository\Console\Commands\MakeRepositoryProviderCommand;
use Miladimos\Repository\Repository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/repository.php", 'repository');

        $this->registerFacades();
    }

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
            __DIR__ . '/../../config/repository.php' => config_path('repository.php')
        ], 'repository-config');

        $this->publishes([
            __DIR__ . '/../Console/Stubs' => resource_path('vendor/miladimos/repository/stubs'),
        ], 'repository-stubs');
    }

    public function registerCommands()
    {
        $this->commands([
            InstallPackageCommand::class,
            MakeRepositoryCommand::class,
            MakeRepositoryProviderCommand::class,
        ]);
    }

    /**
     * Check if package is running under Lumen app
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen') === true;
    }
}
