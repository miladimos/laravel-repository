- [![Starts](https://img.shields.io/github/stars/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/forks)
- [![Forks](https://img.shields.io/github/forks/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/stargazers)

### in your project

`composer require miladimos/laravel-repository`

### for install package

`php artisan repository:install`

### for create new repository

`php artisan make:repository {ModelName}`

### Example:

`php php artisan make:repository Tag`

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
            ModelRepositoryInterface::class,
            Model::class
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

```
