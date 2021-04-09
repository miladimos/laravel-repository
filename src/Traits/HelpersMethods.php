<?php

namespace Miladimos\Repository\Traits;

use Illuminate\Support\Str;

trait HelpersMethods
{

    protected function getRepositoryPath($model)
    {
        $repositoryNamespace = config('repository.repositories_namespace') ?? 'Repositories';

        return app_path($repositoryNamespace . '\\' . $this->getRepositorySuffix($model) . '.php');
    }

    protected function getRepositoryDefaultDirectory()
    {
        $repositoryNamespace = config('repository.repositories_namespace') ?? 'Repositories';
        return app_path($repositoryNamespace);
    }

    protected static function getRepositoryDefaultNamespace($full = true)
    {
        $appNamespace = config('repository.base_app_namespace') ?? 'App';
        $repositoryNamespace = config('repository.repositories_namespace') ?? 'Repositories';
        if ($full)
            return $appNamespace . '\\' . $repositoryNamespace . ';';

        return $appNamespace . '\\' . $repositoryNamespace;
    }

    protected static function getRepositorySuffix($model)
    {
        $repotisorySuffix = config('repositories.repositories_suffix') ?? 'Repository';
        return $model . $repotisorySuffix;
    }

    protected static function getRepositoryInterfaceSuffix($model)
    {
        $interfaceSuffix = config('repositories.interfaces_suffix') ?? 'Interface';
        return $model . $interfaceSuffix;
    }

    protected static function getModelClassName($model)
    {
        return trim(Str::studly($model));
    }

    protected static function getModelNamespace($model)
    {
        $appNamespace = config('repository.base_app_namespace') ?? 'App';
        $modelNamespace = config('repository.models_namespace') ?? 'Models';

        return $appNamespace . '\\' . $modelNamespace . '\\' . $model . ';';
    }

    protected static function getModelPath($model)
    {
        $modelNamespace = config('repository.models_namespace') ?? 'Models';

        return app_path($modelNamespace . '//' . $model);
    }

    protected static function getInterfaceNamespace($model)
    {
        $appNamespace = config('repository.base_app_namespace') ?? 'App';
        $repositoryNamespace = config('repository.repository_namespace') ?? 'Repositories';
        $interfaceNamespace = config('repository.interface_namespace') ?? 'Interfaces';
        $interface = static::getRepositoryInterfaceSuffix($model);

        return $appNamespace . '\\' . $repositoryNamespace . '\\' . $interfaceNamespace . '\\' . $interface . ';';
    }

    protected static function getRepositoryNamespace($model)
    {
        $appNamespace = config('repository.base_app_namespace') ?? 'App';
        $repositoryNamespace = config('repository.repository_namespace') ?? 'Repositories';
        $repository =  static::getRepositorySuffix($model);

        return $appNamespace . '\\' . $repositoryNamespace . '\\' . $model. '\\' . $repository  . ';';
    }


    protected static function getRepositoryServiceProviderPath()
    {
        $ds = DIRECTORY_SEPARATOR;
        return app_path("Providers{$ds}RepositoryServiceProvider.php");
    }
}
