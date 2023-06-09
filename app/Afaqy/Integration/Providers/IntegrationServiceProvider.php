<?php

namespace Afaqy\Integration\Providers;

use Laravel\Passport\Passport;
use Afaqy\Integration\Helpers\ID;
use Afaqy\Integration\Helpers\Tracer;
use Afaqy\Integration\Helpers\SlfToken;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class IntegrationServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        // $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Integration', 'Database/Migrations'));

        Passport::tokensCan([
            'zk' => 'Zk integration',
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('slf', function ($app) {
            return new SlfToken;
        });

        $this->app->bind('tracer', function ($app) {
            return new Tracer;
        });

        $this->app->singleton('ID', function ($app) {
            return (new ID)->generate();
        });

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Integration', 'Config/config.php') => config_path('integration.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Integration', 'Config/config.php'),
            'integration'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/integration');

        $sourcePath = module_path('Integration', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/integration';
        }, \Config::get('view.paths')), [$sourcePath]), 'integration');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/integration');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'integration');
        } else {
            $this->loadTranslationsFrom(module_path('Integration', 'Resources/lang'), 'integration');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Integration', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
