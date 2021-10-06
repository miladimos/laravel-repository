<?php

namespace Miladimos\Repository\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallPackageCommand extends Command
{

    protected $signature = "repository:install";

    protected $name = 'Install repository package';

    protected $description = 'Install laravel-repository Package';

    public function handle()
    {
        $this->info("laravel-repository package installing started...");

        //config
        if (File::exists(config_path('repository.php'))) {
            $confirmConfig = $this->confirm("repository.php already exist. you must overwrite it! Are you ok?");
            if ($confirmConfig) {
                $this->publishConfig();
                $this->info("config publish/overwrite finished");
            } else {
                $this->error("you must publish or overwrite config file");
                die;
            }
        } else {
            $this->publishConfig();
            $this->info("config published");
        }

        // stub files
        $confirmStub = $this->confirm("Do you like publish stubs files?");
        if ($confirmStub) {
            if (File::isDirectory(resource_path('vendor/miladimos/repository/stubs'))) {
                $confirmConfig = $this->confirm("stubs files already exist. you must overwrite it! Are you ok?");
                if ($confirmConfig) {
                    $this->publishStubs();
                    $this->info("stubs publish/overwrite finished");
                } else {
                    $this->error("you must publish and overwrite stubs file");
                    die;
                }
            }
            $this->publishStubs();
            $this->info("stub files published!");
        } else {
            $this->error("you must publish and overwrite stubs file");
            die;
        }

        $this->info("repository package installed successfully! please star me on github!");
        $this->info("https://github.com/miladimos/laravel-repository");

        return 0;
    }

    private function publishConfig()
    {
        $this->call('vendor:publish', [
            '--provider' => "Miladimos\Repository\Providers\RepositoryServiceProvider",
            '--tag'      => "repository-config",
            '--force'    => true,
        ]);
    }

    private function publishStubs()
    {
        $this->call('vendor:publish', [
            '--provider' => "Miladimos\Repository\Providers\RepositoryServiceProvider",
            '--tag'      => "repository-stubs",
            '--force'    => true,
        ]);
    }
}
