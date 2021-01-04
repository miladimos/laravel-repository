<?php

namespace Miladimos\Repository\Traits;


trait getPaths
{

    protected function getDefaultNamespace($rootNamespace = "app")
    {
        $repositoryNamespace = config('repository.namespace');
        return $rootNamespace . "\\$repositoryNamespace";
    }

     /**
     * Return repository base namespace.
     *
     * @return string
     */
    protected function getRepositoryBaseNamespace()
    {
        return config('repositories.base_application_namespace') . '\\' . config('repositories.repositories_base_namespace');
    }

}
