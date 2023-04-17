- [![Starts](https://img.shields.io/github/stars/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/forks)
- [![Forks](https://img.shields.io/github/forks/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/stargazers)

### in your project

`composer require miladimos/laravel-repository`

### for install package

`php artisan repository:install`

### for create new repository

`php artisan make:repository {ModelName}`

### Example:

`php artisan make:repository Tag`

this create a TagRepository and TagEloquentRepositoryInterface

next you must add Repository to RepositoryServiceProvider in repositories property like:

```php
protected $repositories = [
    [
        TagEloquentRepositoryInterface::class,
        TagRepository::class,
    ],
];
```

next in your controller add this:

```php
private $tagRepo;
public function __construct(TagEloquentRepositoryInterface $tagRepo)
{
    $this->tagRepo = $tagRepo;
}

```

add custom methods in TagEloquentRepositoryInterface and implement them.

you must have a provider with below content and register it:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
    * define your repositories here
    */
    protected $repositories = [
        [
            ModelEloquentRepositoryInterface::class,
            ModelRepository::class
        ],
    ];

    public function register()
    {
        foreach ($this->repositories as $repository) {
            $this->app->bind($repository[0], $repository[1]);
        }
    }
}
```

or create it automatically by below command:

```php
php artisan make:repository:provider
```

and add to app.php providers:

```php
App\Providers\RepositoryServiceProvider::class,
```

#### Methods:

```php
$model->all($columns = ['*']);

$model->create(array $data);

$model->update(array $data, $id, $attribute = "id");

$model->find($id);

$model->findOrFail($id);

$model->findWhere(string $field, $condition, $columns);

$model->first();

$model->last();

$model->firstOrCreate();

$model->whereIn($attribute, array $values);

$model->max($column);

$model->min($column);

$model->avg($column);

$model->delete($id);

$model->truncate();

$model->count($columns = ['*']);

$model->paginate($columns = ['*'], $perPage = 8);

$model->simplePaginate($limit = null, $columns = ['*']);

$model->search(array $query, $columns = ["*"]);

$model->pluck($value, $key = null);

$model->with($relations);

$model->toSql();


```
