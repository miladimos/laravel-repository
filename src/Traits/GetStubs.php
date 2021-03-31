<?php

namespace Miladimos\Repository\Traits;

trait GetStubs
{

    protected static function getRepositoryStub()
    {
        return file_get_contents(static::stubPath() . "/repository.stub");
    }

    protected static function getRepositoryServiceProviderStub()
    {
        return file_get_contents(static::stubPath() . "/RepositoryServiceProvider.stub");
    }

    protected static function getRepositoryInterfaceStub()
    {
        return file_get_contents(static::stubPath() . "/RepositoryInterface.stub");
    }

    protected static function getStub($type)
    {
        return file_get_contents(static::stubPath() . "/$type.stub");
    }

    public static function stubPath()
    {
        $vendor = "vendor/miladimos/repository";
        return resource_path($vendor . '//stubs');
    }
}
