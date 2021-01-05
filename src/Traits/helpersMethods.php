<?php

namespace Miladimos\Repository\Traits;

use Illuminate\Support\Str;


trait helpersMethods
{

    protected function getRepositoryDefaultNamespace()
    {
        $repositoryNamespace = config('repository.repositories_namespace') ?? 'Repositories';
        return app_path($repositoryNamespace);
    }


    /**
     * Get the repository's class name.
     *
     * @param string $model
     * @return string
     */
    protected static function getRepositorySuffix($model)
    {
        $repotisorySuffix = config('repositories.repositories_suffix') ?? 'Repository';
        return $model . $repotisorySuffix;
    }

    /**
     * Get the class name of the model name.
     *
     * @param string $model
     * @return string
     */
    protected static function getModelClassName($model)
    {
        return Str::studly($model);
    }

    protected static function getModelNamespace($model)
    {
        $appNamespace = config('repository.base_app_namespace') ?? 'App';
        $modelNamespace = config('repository.models_namespace') ?? 'Models';

        return $appNamespace . '\\' . $modelNamespace . '\\' . $model . ';';
    }



}
