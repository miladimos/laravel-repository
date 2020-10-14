<?php

namespace Miladimos\Repository\Console\Commands;


use Illuminate\Console\Command;

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
        $this->warn("Repository is creating ...");

        try {
            $this->info("");
        }catch (\Exception $exception) {
            $this->error($exception);
        }

        return 0;
    }
}
