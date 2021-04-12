- [![Starts](https://img.shields.io/github/stars/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/forks)
- [![Forks](https://img.shields.io/github/forks/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/stargazers)

- [فارسی](README.md)

## Installation

``composer require miladimos/laravel-repository``


### For Installation run below command: 

``php artisan repository:install``


### For Create new Repository: 

``php artisan make:repository {ModelName}``

### Example:

``php php artisan make:repository Tag``

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







