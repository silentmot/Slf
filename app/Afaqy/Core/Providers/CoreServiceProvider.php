<?php

namespace Afaqy\Core\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Passport::tokensCan([
            'zk'      => 'Zk integration',
            'avl'     => 'AVL integration',
            'masader' => 'Masader integration',
            'cap'     => 'CAP integration',
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
    }
}
