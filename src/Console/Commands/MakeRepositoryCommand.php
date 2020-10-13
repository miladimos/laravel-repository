<?php

namespace Miladimos\Repository\Console\Commands;


use Illuminate\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
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


    protected $type = 'Repository';


    protected function getStub()
    {
        return __DIR__ . '/../Stubs/repository.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $repositoryNamespace = config('repository.namespace');
        return $rootNamespace . "\\$repositoryNamespace";
    }

    protected function getNameInput()
    {
        return $this->option('model');
    }

//    public function handle()
//    {
//        parent::handle();
//
//        $this->createRepository();
//    }
//
//    protected function createRepository()
//    {
//        // Get the fully qualified class name (FQN)
//        $class = $this->qualifyClass($this->getNameInput());
//
//        // get the destination path, based on the default namespace
//        $path = $this->getPath($class);
//
//        $content = file_get_contents($path);
//
//        // Update the file content with additional data (regular expressions)
//
//        file_put_contents($path, $content);
//    }


//    /**
//     * Execute the console command.
//     *
//     * @return int
//     */
    public function handle()
    {
        $this->info('Command Working');
        $modelName = $this->argument('model');

        $this->info("Model Name: {$modelName}");
        return 0;
    }
}
