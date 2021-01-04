<?php

namespace Miladimos\Repository\Traits;


trait getStubs
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected static function getRepositoryStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/repository/stubs/repository.stub"));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected static function getRepositoryServiceProviderStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/repository/stubs/RepositoryServiceProvider.stub"));
    }

    protected static function getStubs($type)
    {
        return file_get_contents(resource_path("vendor/miladimos/repository/stubs/$type.stub"));
    }


     /**
   * Get path to the stubs.
   *
   * @return string
   */
  public function stubPath() {
    return __DIR__ . '/stubs';
  }

}
