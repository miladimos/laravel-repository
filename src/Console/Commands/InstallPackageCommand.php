<?php

namespace Miladimos\Repository\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
        $this->warn("Repository Package installing started ...");

        $bar = $this->output->createProgressBar(100);

        $bar->start();

        try {
            $this->call('vendor:publish', [
                '--provider' => "Miladimos\Repository\Providers\RepositoryServiceProvider",
                '--tag' => "repository-config"
            ]);
            $this->info("config files published.");

            $this->call('vendor:publish', [
                '--provider' => "Miladimos\Repository\Providers\RepositoryServiceProvider",
                '--tag' => "repository-stubs"
            ]);
            $this->info("stubs files published.");
        }catch (\Exception $exception) {
            $this->error($exception);
        }

        $bar->finish();

        return 0;
    }
}
