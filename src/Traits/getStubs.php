<?php

namespace Miladimos\Repository\Traits;


trait GetStubs
{

    protected static function getRepositoryStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/repository/stubs/repository.stub"));
    }

    protected static function getRepositoryServiceProviderStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/repository/stubs/RepositoryServiceProvider.stub"));
    }

    protected static function getRepositoryInterfaceStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/repository/stubs/RepositoryInterface.stub"));
    }

    protected static function getStub($type)
    {
        return file_get_contents(resource_path("vendor/miladimos/repository/stubs/$type.stub"));
    }

    public function stubPath()
    {
        return resource_path('vendor/miladimos/repository/stubs');
    }
}
