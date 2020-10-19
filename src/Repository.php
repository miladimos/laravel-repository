<?php


namespace Miladimos\Repository;


use Miladimos\Repository\Providers\SocialServiceProvider;
use Miladimos\Repository\Repositories\IBaseRepositoryInterface;

class Repository
{
    /**
     * @var string
     */
     const NAMESPACE = 'App\\Repositories';

    /**
     * @var string
     */
    protected $base = IBaseRepositoryInterface::class;


    protected function getDefaultNamespace($rootNamespace = "app")
    {
        $repositoryNamespace = config('repository.namespace');
        return $rootNamespace . "\\$repositoryNamespace";
    }

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


    protected static function createRepository($name)
    {
        $template = str_replace(
            ['{{$modelName}}'],
            [$name],
            self::getRepositoryStub()
        );

        file_put_contents(base_path("/App/Repositories/{$name}Repository.php"), $template);
    }

    protected static function createProvider()
    {
        $template =  self::getRepositoryServiceProviderStub();

        if (!file_exists($path=base_path('/App/Providers/RepositoryServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/RepositoryServiceProvider.php'), $template);
    }

    public static function make($modelName)
    {
        if (!file_exists($path=base_path(self::NAMESPACE)))
            mkdir($path, 0777, true);

        self::createProvider();
        self::createRepository($modelName);

        return true;
    }
}
