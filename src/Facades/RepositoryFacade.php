<?php

namespace Miladimos\Repository\Facades;

use Illuminate\Support\Facades\Facade;

class RepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'repository';
    }
}
