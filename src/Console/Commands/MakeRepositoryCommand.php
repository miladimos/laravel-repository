<?php

namespace Miladimos\Repository\Console\Commands;


use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Miladimos\Repository\Repository;

class MakeRepositoryCommand extends Command
{

    protected $signature = "make:repository
                           { model : Model Name }";

    protected $name = 'Repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make New Repository';


    public function handle()
    {
        $modelName = trim(Str::studly($this->argument('model')));

        $this->warn("Repository {$modelName} is creating ...");

        try {
            if(Repository::make($modelName))
                $this->info("Repository Model: {$modelName} is created successfully.");
            else
                $this->error('Error in Creating Repository!');
                die;
        }catch (\Exception $exception) {
            $this->error($exception);
            die;
        }

        return 0;
    }

}
