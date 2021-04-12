- [![Starts](https://img.shields.io/github/stars/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/forks)
- [![Forks](https://img.shields.io/github/forks/miladimos/laravel-repository?style=flat&logo=github)](https://github.com/miladimos/laravel-repository/stargazers)


- [English](README-en.md)

### برای نصب در مسیر روت پروژه خود دستور زیر را در ریشه پروژه اجرا کنید 

``composer require miladimos/laravel-repository``

### پکیج از دستور زیر استفاده کنید 

``php artisan repository:install``


### برای ایجاد یک ریپازیتوری از دستور زیر استفاده کنید 

``php artisan make:repository {ModelName}``


### مثال:

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


