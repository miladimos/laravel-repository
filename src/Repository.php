<?php

namespace Miladimos\Repository;

use Illuminate\Support\Facades\File;
use Miladimos\Repository\Traits\GetStubs;
use Miladimos\Repository\Traits\HelpersMethods;
use Miladimos\Repository\Traits\ValidateModel;

class Repository
{
    use GetStubs,
        HelpersMethods,
        ValidateModel;


    protected static function createProvider()
    {
        $template =  self::getRepositoryServiceProviderStub();

        if (!file_exists($path = base_path('/App/Providers/RepositoryServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/RepositoryServiceProvider.php'), $template);
    }

    protected static function createRepository($name)
    {
        $modelNamespace = self::getModelNamespace($name);
        $interfaceNamespace = self::getInterfaceNamespace($name);
        $repositoryNamespace = self::getRepositoryNamespace($name);

        $template = str_replace(
            ['{{ $modelName }}', '{{ $modelNamespace }}', '{{ $repositoryNamespace }}', '{{ $interfaceNamespace }}'],
            [$name, $modelNamespace, $repositoryNamespace, $interfaceNamespace],
            self::getRepositoryStub()
        );

        file_put_contents(base_path("/App/Repositories/{$name}Repository.php"), $template);
    }

    protected static function createInterface($name)
    {
        $interfaceNamespace = self::getInterfaceNamespace($name);
        $template = str_replace(
            ['{{ $interfaceNamespace }}'],
            [$$interfaceNamespace],
            self::getRepositoryInterfaceStub()
        );

        file_put_contents(base_path("/Repositories/{$name}EloquentRepositoryInterface.php"), $template);
    }

    public static function make($modelName)
    {

        if (!File::isDirectory($path = (new self)->getRepositoryDefaultDirectory()))
            mkdir($path, 0777, true);

        self::createRepository($modelName);
        // self::createInterface($modelName);

        return true;
    }
}
