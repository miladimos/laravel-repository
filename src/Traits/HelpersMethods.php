<?php

namespace Miladimos\Repository\Traits;

use Illuminate\Support\Str;

trait HelpersMethods
{

    protected function getRepositoryPath($model)
    {
        $repositoryNamespace = config('repository.repositories_namespace') ?? 'Repositories';
        return app_path($repositoryNamespace . '//' . $model);
    }

    protected function getRepositoryDefaultDirectory()
    {
        $repositoryNamespace = config('repository.repositories_namespace') ?? 'Repositories';
        return app_path($repositoryNamespace);
    }

    protected function getRepositoryDefaultNamespace($full = true)
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
        $interfaceNamespace = config('repository.interface_namespace') ?? 'Interfaces';

        return $appNamespace . '\\' . $interfaceNamespace . '\\' . $model . ';';
    }
}
