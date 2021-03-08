<?php

namespace Miladimos\Repository\Traits;

trait GetStubs
{

    private $vendor = "vendor/miladimos/repository";

    protected static function getRepositoryStub()
    {
        return file_get_contents($this->stubPath() ."/repository.stub");
    }

    protected static function getRepositoryServiceProviderStub()
    {
        return file_get_contents($this->stubPath() ."/RepositoryServiceProvider.stub");
    }

    protected static function getRepositoryInterfaceStub()
    {
        return file_get_contents($this->stubPath() ."/RepositoryInterface.stub");
    }

    protected static function getStub($type)
    {
        return file_get_contents($this->stubPath() ."/$type.stub");
    }

    public function stubPath()
    {
        return resource_path($this->vendor . '//stubs');
    }
}
