<?php

return [
    'repository' => [

        /**
         * The base namespace of your application.
         */
        'application_namespace' => 'App',

        /*
         *  Path that contains Models
         * */
        'models_namespace' =>'Models',

        /*
         *  Path that contains Repositories
         *
         * application_namespace + repositories_namespace
         * */
        'repositories_namespace' => 'Repositories',

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
        'repository_interface_base_namespace' => 'Repositories\Interfaces',


    ]
];
