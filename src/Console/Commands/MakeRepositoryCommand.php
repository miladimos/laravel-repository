<?php

namespace Miladimos\Repository\Console\Commands;


use Illuminate\Console\Command;
use Miladimos\Repository\Repository;

class MakeRepositoryCommand extends Command
{

//
//    /**
//     * Create a new command instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        parent::__construct();
//    }
//

    protected $signature = "make:repository
                           { model : Model Name}";

    protected $name = 'Repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make New Repository';


    public function handle()
    {
        $modelName = $this->argument('model');

        $this->warn("Repository {$modelName} is creating ...");

        try {
            Repository::make($modelName);
            
            $this->info("Repository Model: {$modelName} is created successfully.");
        }catch (\Exception $exception) {
            $this->error('Error');
        }


        return 0;
    }
}
