<?php

return [

    /*
      *  Path that contains Models
    * */
    'application_namespace' => 'App',

    /*
     *  Path that contains Models
    * */
    'models_namespace' => 'Models',

    /*
    *  Path that contains Repositories
    *
    * application_namespace + repositories_namespace
    * */
    'repositories_namespace' => 'Repositories',

    /*
    *  Path that contains Repositories
    *
    * application_namespace + repositories_namespace
    * */
    'interfaces_namespace' => 'Interfaces',

    /*
    * Suffix for Created Repositories
    *
    * ex: $modelNameRepository
    *
    * */
    'repositories_suffix' => 'Repository',

    /**
     * The base path in which the repository interfaces are stored.
     */
    'repository_interface_base_path' => 'Repositories/Interfaces',

    /**
     * The base namespace, relative to application base namespace, for your repositories' interfaces.
     */
    'repository_interface_base_namespace' => '',

    'per_page' => 50,
    'max_per_page' => 100,

    /*
     |--------------------------------------------------------------------------
     | Caching Status
     |--------------------------------------------------------------------------
     */
    'cache_enabled' => true,

];

return $a;

// // $b =[];

// // $b = $a;

// $a['repository_interface_base_path'] = $a['repositories_namespace'] . '+++++++'. $a['interfaces_namespace'];

// return $a;
