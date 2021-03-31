<?php

return [

    /**
     * Application Namespace
     */
    'application_namespace' => 'App',

    /**
     *  Path that contains Models
     *
     *  application_namespace + \ + models_namespace ==> App\Models
     */
    'models_namespace' => 'Models',

    /**
     * Path that contains Repositories
     *
     * application_namespace + repositories_namespace ==> App\Repositories
     *
     */
    'repositories_namespace' => 'Repositories',

    /**
     *  Path that contains Repository Interfaces
     *
     *  application_namespace + repositories_namespace ==> App\Repositories\Interfaces;
     */
    'interfaces_namespace' => 'Interfaces',

    /**
     * Suffix for Created Repositories
     *
     * ex: $modelNameRepository
     *
     */
    'repositories_suffix' => 'Repository',

    /**
     * Suffix for Created Repositories
     *
     * ex: $modelNameInterface
     *
     */
    'interfaces_suffix' => 'Interface',

    /**
     * Pagination Settings
     */
    'pagination' => [
        'per_page' => 8,
        'max_per_page' => 28,
    ],

    /*
     |--------------------------------------------------------------------------
     | Caching Status
     |--------------------------------------------------------------------------
     */
    'cache_enabled' => true,

];
