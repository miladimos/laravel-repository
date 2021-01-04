<?php


namespace Miladimos\Repository;


use Miladimos\Repository\Traits\getStubs;
use Miladimos\Repository\Traits\validateModel;
use Miladimos\Repository\Traits\helpersMethods;

class Repository
{
    use getStubs, helpersMethods, validateModel;


    protected static function createRepository($name)
    {
        $template = str_replace(
            ['{{$modelName}}'],
            [$name],
            self::getRepositoryStub()
        );

        file_put_contents(base_path("/App/Repositories/{$name}Repository.php"), $template);
    }

    protected static function createProvider()
    {
        $template =  self::getRepositoryServiceProviderStub();

        if (!file_exists($path=base_path('/App/Providers/RepositoryServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/RepositoryServiceProvider.php'), $template);
    }

    protected static function createInterface($name)
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],

            self::GetStubs('RepositoryInterface')
        );

        file_put_contents(base_path("/Repositories/{$name}RepositoryInterface.php"), $template);

    }

    public static function make($modelName)
    {

        if (!file_exists($path=(new self)->getRepositoryDefaultNamespace()))
            mkdir($path, 0777, true);

        self::createProvider();
        self::createInterface($modelName);
        self::createRepository($modelName);

        return true;
    }
}
