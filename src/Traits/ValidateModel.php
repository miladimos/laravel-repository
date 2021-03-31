<?php

namespace Miladimos\Repository\Traits;

trait ValidateModel
{
    protected function ensureRepositoryDoesntAlreadytExist($model)
    {
        if (file_exists($this->getRepositoryPath($model))) {
            return true;
        }
        return false;
    }
}
