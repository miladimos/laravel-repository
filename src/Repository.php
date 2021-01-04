<?php


namespace Miladimos\Repository;


use Miladimos\Repository\Traits\getPaths;
use Miladimos\Repository\Traits\getStubs;
use Miladimos\Repository\Traits\validateModel;
use Miladimos\Repository\Repositories\IBaseRepositoryInterface;

class Repository
{
    use getStubs, getPaths, validateModel;


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

    protected static function MakeInterface($name)
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],

            self::GetStubs('RepositoryInterface')
        );

        file_put_contents(base_path("/Repositories/{$name}RepositoryInterface.php"), $template);

    }

    public static function make($modelName)
    {
        if (!file_exists($path=base_path(self::NAMESPACE)))
            mkdir($path, 0777, true);

        self::createProvider();
        self::MakeInterface($name);
        self::createRepository($modelName);

        return true;
    }

    protected function ensureRepositoryDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getRepositoryNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
      }


       /**
   * Get path to the stubs.
   *
   * @return string
   */
  public function stubPath() {
    return __DIR__ . '/stubs';
  }

  /**
   * Get the class name of the model name.
   *
   * @param string $model
   * @return string
   */
  protected function getClassName($model) {
    return Str::studly($model);
  }

  /**
   * Get the repository's class name.
   *
   * @param string $model
   * @return string
   */
  protected function getRepositoryClassName($model) {
    $modelPrefix = config('repositories.pluralise') ? Str::plural($model) : $model;
    return $modelPrefix . 'Repository';
  }
}
