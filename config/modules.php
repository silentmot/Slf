<?php

use Nwidart\Modules\Activators\FileActivator;

return [
    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
     */
    'namespace'  => 'Afaqy',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
     */
    'stubs'      => [
        'enabled'      => true,
        'path'         => base_path() . '/app/Afaqy/Core/Console/LaravelModules/Commands/stubs',
        'files' => [
            'routes/web' => 'Routes/web.php',
            'routes/api' => 'Routes/api.php',
            'views/index' => 'Resources/views/index.blade.php',
            'views/master' => 'Resources/views/layouts/master.blade.php',
            'scaffold/config' => 'Config/config.php',
            'composer' => 'composer.json',
            'assets/js/app' => 'Resources/assets/js/app.js',
            'assets/sass/app' => 'Resources/assets/sass/app.scss',
            'webpack' => 'webpack.mix.js',
            'package' => 'package.json',
        ],
        'replacements' => [
            'routes/web' => ['LOWER_NAME', 'STUDLY_NAME'],
            'routes/api' => ['LOWER_NAME'],
            'webpack' => ['LOWER_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
            ],
        ],
        'gitkeep'      => false,
    ],
    'paths'      => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
         */
        'modules'   => base_path('app/Afaqy'),

        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
         */
        'assets'    => public_path('modules'),

        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
         */
        'migration' => base_path('database/migrations'),

        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
         */
        'generator' => [
            'config'         => ['path' => 'Config', 'generate' => false],
            'command'        => ['path' => 'Console', 'generate' => false],
            'migration'      => ['path' => 'Database/Migrations', 'generate' => true],
            'seeder'         => ['path' => 'Database/Seeders', 'generate' => true],
            'factory'        => ['path' => 'Database/factories', 'generate' => true],
            'model'          => ['path' => 'Models', 'generate' => true],
            'controller'     => ['path' => 'Http/Controllers', 'generate' => true],
            'filter'         => ['path' => 'Http/Middleware', 'generate' => true],
            'request'        => ['path' => 'Http/Requests', 'generate' => true],
            'provider'       => ['path' => 'Providers', 'generate' => true],
            'assets'         => ['path' => 'Resources/assets', 'generate' => false],
            'lang'           => ['path' => 'Resources/lang', 'generate' => true],
            'views'          => ['path' => 'Resources/views', 'generate' => false],
            'test'           => ['path' => 'Tests/Unit', 'generate' => true],
            'test-feature'   => ['path' => 'Tests/Feature', 'generate' => true],
            'repository'     => ['path' => 'Repositories', 'generate' => false],
            'event'          => ['path' => 'Events', 'generate' => false],
            'listener'       => ['path' => 'Listeners', 'generate' => false],
            'policies'       => ['path' => 'Policies', 'generate' => false],
            'rules'          => ['path' => 'Rules', 'generate' => false],
            'jobs'           => ['path' => 'Jobs', 'generate' => false],
            'emails'         => ['path' => 'Emails', 'generate' => false],
            'notifications'  => ['path' => 'Notifications', 'generate' => false],
            'resource'       => ['path' => 'Http/Transformers', 'generate' => false],
            'action'         => ['path' => 'Actions', 'generate' => true],
            'aggregator'     => ['path' => 'Actions/Aggregators', 'generate' => false],
            'dto-collection' => ['path' => 'DTO/Collections', 'generate' => false],
            'dto'            => ['path' => 'DTO', 'generate' => true],
            'model-filter'   => ['path' => 'Models/Filters', 'generate' => true],
            'report'         => ['path' => 'Http/Reports', 'generate' => true],
            'transformer'    => ['path' => 'Http/Transformers', 'generate' => true],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
     */
    'scan'       => [
        'enabled' => false,
        'paths'   => [
            base_path('vendor/*/*'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
     */
    'composer'   => [
        'vendor' => 'Afaqy',
        'author' => [
            'name'  => 'Afaqy Company',
            'email' => 'info@afaqy.com',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
     */
    'cache'      => [
        'enabled'  => false,
        'key'      => 'afaqy',
        'lifetime' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
     */
    'register'   => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files'        => 'register',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
     */
    'activators' => [
        'file' => [
            'class'          => FileActivator::class,
            'statuses-file'  => base_path('modules_statuses.json'),
            'cache-key'      => 'activator.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'activator'  => 'file',
];
