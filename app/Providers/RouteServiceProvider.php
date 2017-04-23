<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //注册全局路由参数规则
        Route::patterns([
            'id' => '[0-9]+',
        ]);
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
        Route::middleware('web')
            ->namespace($this->namespace . '\Admin')
            ->prefix('admin')
            ->group(base_path('routes/admin/web.php'));
        // 获取图片无中间件
        Route::get('pic/{PictureId}_{size}', 'App\Http\Controllers\PicturesController@show')->name('pic');

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $api = app('Dingo\Api\Routing\Router');
        $api->version('v1', ['namespace' => $this->namespace, 'middleware' => 'api'], function ($api) {
            $api->group(['namespace' => 'Admin\Api', 'prefix' => 'admin'], function ($api) {
                require base_path('routes/admin/api.php');
            });
        });
    }
}
