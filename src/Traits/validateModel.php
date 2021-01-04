<?php namespace Miladimos\Repository\Traits;

use InvalidArgumentException;


trait validateModel
{

    protected function ensureRepositoryDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getRepositoryNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
    }

}
