<?php

namespace Miladimos\Repository\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Miladimos\Repository\Repository;
use Miladimos\Repository\Traits\GetStubs;
use Miladimos\Repository\Traits\ValidateModel;
use Miladimos\Repository\Traits\HelpersMethods;

class MakeRepositoryCommand extends Command
{
    use GetStubs,
        HelpersMethods,
        ValidateModel;

    protected $signature = "make:repository
                           { model : Model Name }";

    protected $name = 'Repository';

    protected $description = 'Create a new Repository';

    protected $modelName;

    public function handle()
    {
        dd(config('repository'));
        $this->modelName = trim(Str::studly($this->argument('model')));

        $this->warn("Repository {$this->modelName} is creating ...");

        try {
            if ((new self)->ensureRepositoryDoesntAlreadytExist($this->modelName)) {
                $msg = (new self)->getRepositoryFilePath($this->modelName) . " already exist. you must overwrite it! Are you ok?";

                $confirm = $this->confirm($msg);
                if ($confirm) {
                    if (Toolkit::makeRepository($this->modelName)) {
                        $this->info("$this->modelName.php overwrite finished");
                        die;
                    } else {
                        $this->error('Error in overwriting Repository!');
                        die;
                    }
                } else {
                    $this->modelName = $this->ask("Enter the Repository file name? ");
                }
            }

            if (Toolkit::makeRepository($this->modelName)) {
                $this->info("Full Repository file: {$this->modelName} is created successfully.");
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
