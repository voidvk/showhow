<?php

namespace App\Admin;

use App\Admin\Facades\AdminMenu;
use App\Admin\Http\Middleware\AdminMiddleware;
use App\Admin\Libraries\Menu;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/**
 * AdminServiceProvider
 *
 * @author Viktor Vassilyev <viktor.v@bilimmail.kz>
 */
class AdminServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('admin_menu', function ($app) {
            return new Menu();
        });
        AliasLoader::getInstance()->alias('AdminMenu', AdminMenu::class);
        $this->app[\Illuminate\Routing\Router::class]->aliasMiddleware('admin', AdminMiddleware::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['admin_menu'];
    }

}
