<?php

namespace Miladimos\Repository;

use Illuminate\Support\Facades\File;
use Miladimos\Repository\Traits\GetStubs;
use Miladimos\Repository\Traits\HelpersMethods;
use Miladimos\Repository\Traits\Validation;

class Repository
{
    use GetStubs,
        HelpersMethods,
        Validation;

    public static function createProvider($providerName)
    {
        $path = self::getRepositoryServiceProviderPath($providerName);
        $template = str_replace(
            ['{{ $providerName }}'],
            [$providerName],
            self::getRepositoryServiceProviderStub()
        );

        if (self::ensureRepositoryServiceProviderDoesntAlreadytExist($providerName)) {
            file_put_contents($path, $template);
            return true;
        }
        return false;
    }

    protected static function createRepository($name)
    {
        $modelNamespace = self::getModelNamespace($name);
        $repositoryInterfaceNamespace = self::getRepositoryInterfaceNamespace($name);
        $repositoryNamespace = self::getRepositoryNamespace($name);

        $template = str_replace(
            ['{{ $modelName }}', '{{ $modelNamespace }}', '{{ $repositoryNamespace }}', '{{ $repositoryInterfaceNamespace }}'],
            [$name, $modelNamespace, $repositoryNamespace, $repositoryInterfaceNamespace],
            self::getRepositoryStub()
        );

        if (!File::isDirectory($path = base_path("/App/Repositories/{$name}")))
            mkdir($path, 0777, true);

        file_put_contents("$path/{$name}Repository.php", $template);
    }

    protected static function createInterface($name)
    {
        $repositoryInterfaceNamespace = self::getInterfaceNamespace($name);
        $template = str_replace(
            ['{{ $repositoryInterfaceNamespace }}', '{{ $modelName }}'],
            [$repositoryInterfaceNamespace, $name],
            self::getRepositoryInterfaceStub()
        );

        if (!File::isDirectory($path = base_path("/App/Repositories/{$name}")))
            mkdir($path, 0777, true);

        file_put_contents("{$path}/{$name}EloquentRepositoryInterface.php", $template);
    }

    public static function make($modelName)
    {

        if (!File::isDirectory($path = (new self)->getRepositoryDefaultDirectory()))
            mkdir($path, 0777, true);

        self::createRepository($modelName);
        self::createInterface($modelName);

        return true;
    }
}
