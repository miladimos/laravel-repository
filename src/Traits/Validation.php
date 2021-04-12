<?php

namespace Miladimos\Repository\Traits;

trait Validation
{
    protected function ensureRepositoryDoesntAlreadytExist($model)
    {
        if (file_exists($this->getRepositoryPath($model))) {
            return true;
        }
        return false;
    }

    public static function ensureRepositoryServiceProviderDoesntAlreadytExist($providerName)
    {
        if (file_exists(self::getRepositoryServiceProviderPath($providerName))) {
            return false;
        }
        return true;
    }
}
