<?php

namespace Miladimos\Repository\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallPackageCommand extends Command
{

    protected $signature = "repository:install";

    protected $name = 'Install Package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simply Install laravel-repository Package';


    public function handle()
    {
        $this->warn("Repository Package installing started...");


        //config
        if (File::exists(config_path('repository.php'))) {
            $confirmConfig = $this->confirm("repository.php already exist. you must overwrite it! Are you ok?");
            if ($confirmConfig) {
                $this->publishConfig();
                $this->info("config publish/overwrite finished");
            } else {
                $this->error("you must publish and overwrite config file");
                die;
            }
        } else {
            $this->publishConfig();
            $this->info("config published");
        }

        $confirmStub = $this->confirm("Do you like publish stub files?");
        if($confirmStub) {
            $this->publishStubs();
            $this->info("stub files published!");
        }

        $this->info("repository package installed successfully! please star me on github!");

        return 0;
    }


    private function publishConfig()
    {
        $this->call('vendor:publish', [
            '--provider' => "Miladimos\Repository\Providers\RepositoryServiceProvider",
            '--tag' => "repository-config"
        ]);
    }

    private function publishStubs()
    {
        $this->call('vendor:publish', [
            '--provider' => "Miladimos\Repository\Providers\RepositoryServiceProvider",
            '--tag' => "repository-stubs"
        ]);
    }
}
