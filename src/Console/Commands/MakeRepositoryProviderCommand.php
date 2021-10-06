<?php

namespace Miladimos\Repository\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Miladimos\Repository\Repository;
use Miladimos\Repository\Traits\GetStubs;
use Miladimos\Repository\Traits\Validation;
use Miladimos\Repository\Traits\HelpersMethods;

class MakeRepositoryProviderCommand extends Command
{
    use GetStubs,
        HelpersMethods,
        Validation;

    protected $signature = "make:repository:provider
                            {name=RepositoryServiceProvider : Provider name}";

    protected $description = 'Create a Service provider for repository ';

    protected $name;

    public function handle()
    {
        $this->name = trim(Str::studly($this->argument('name')));

        $this->warn("Serivce Provider {$this->name} is creating...");

        try {

            if (Repository::createProvider($this->name)) {
                $this->info("Service Provider: {$this->name} is created successfully.");
            } else {
                $msg = ' ""' . $this->name . '""' . " already exist. do you want create another?";
                $confirm = $this->confirm($msg);
                if ($confirm) {
                    $this->name = $this->ask("Enter the Provider name? ");
                    if (Repository::createProvider($this->name)) {
                        $this->info("Service Provider file: {$this->name} is created successfully.");
                    } else {
                        $this->error("error");
                        die;
                    }
                } else {
                    $this->warn("You must have a Provider for Repositories. create it");
                    die;
                }
            }
        } catch (\Exception $exception) {
            $this->error($exception);
            die;
        }

        return 0;
    }
}
