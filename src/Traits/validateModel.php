<?php

namespace Miladimos\Repository\Traits;

trait ValidateModel
{

    protected function ensureRepositoryDoesntAlreadytExist($model)
    {
        if (class_exists($classFullyQualified = $this->getRepositoryNamespace($model), false)) {
            return true;
        }
        return false;
    }
}
