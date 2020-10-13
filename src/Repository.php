<?php


namespace Miladimos\Repository;


class Repository
{


    protected function getDefaultNamespace($rootNamespace)
    {
        $repositoryNamespace = config('repository.namespace');
        return $rootNamespace . "\\$repositoryNamespace";
    }


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
    public function make(string $modelName)
    {
        return 'test';
    }
}
