<?php

namespace Miladimos\Repository\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Miladimos\Repository\Repository;
use Miladimos\Repository\Traits\GetStubs;
use Miladimos\Repository\Traits\Validation;
use Miladimos\Repository\Traits\HelpersMethods;

class MakeRepositoryCommand extends Command
{
    use GetStubs,
        HelpersMethods,
        Validation;

    protected $signature = "make:repository
                           { model : Model Name } {--f|force}";

    protected $name = 'Repository';

    protected $description = 'Create a new Repository';

    protected $modelName;

    public function handle()
    {
        $this->modelName = trim(Str::studly($this->argument('model')));

        $this->warn("Repository {$this->modelName} is creating ...");

        try {

            if ((new self)->ensureRepositoryDoesntAlreadytExist($this->modelName)) {
                $msg = ' ""' . (new self)->getRepositoryPath($this->modelName) . '""' . " already exist. you must overwrite it! Are you ok?";

                $confirm = $this->confirm($msg);
                if ($confirm) {
                    if (Repository::make($this->modelName)) {
                        $this->info("{$this->modelName}Repository.php overwrite finished");
                        die;
                    } else {
                        $this->error('Error in overwriting Repository!');
                        die;
                    }
                } else {
                    $this->modelName = $this->ask("Enter the Repository another file name? ");
                }
            }

            if (Repository::make($this->modelName)) {
                $this->info("Repository file: {$this->modelName} is created successfully.");
                die;
            } else {
                $this->error('Error in creating Repository!');
                die;
            }
        } catch (\Exception $exception) {
            $this->error($exception);
            die;
        }

        return 0;
    }
}
