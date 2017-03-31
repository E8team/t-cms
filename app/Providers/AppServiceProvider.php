<?php

namespace App\Providers;

use App\Entities\Setting;
use App\Libs\Theme;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*\DB::listen(function ($query) {
            dd($query->sql
            ,$query->bindings
            ,$query->time);
        });*/

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $apiHandler = app('Dingo\Api\Exception\Handler');
        $apiHandler->register(function (\Illuminate\Auth\AuthenticationException $exception) {
            return response([
                'code' => 401.1,
                //todo 国际化
                'message' => '请先登录!'
            ], 401);
        });
        $apiHandler->register(function (AuthorizationException $exception) {
            return response([
                'code' => 401.3,
                //todo 国际化
                'message' => $exception->getMessage()=='This action is unauthorized.'?'没有权限!':$exception->getMessage()
            ], 401);
        });

        $this->app->singleton(Theme::class, function ($app) {
            return new Theme($app['filesystem']->disk('theme'), Setting::getSetting('current_theme'));
        });


    }
}
