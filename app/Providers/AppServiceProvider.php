<?php

namespace App\Providers;

use App\Entities\Setting;
use App\Libs\Theme;
use Illuminate\Support\Facades\Validator;
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
        \DB::listen(function ($query) {
            \Log::info('sql',[$query->sql
            ,$query->bindings
            ,$query->time]);
        });
        Validator::extend('picture_id', function($attribute, $value, $parameters, $validator) {

            return preg_match('/[0-9a-z]{32}\.'.'('.implode('|', config('picture.allowTypeList')).')'.'/i', $value)==1;
        }, '图片上传错误!');
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
        $apiHandler->register(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            return response([
                'code' => 401.3,
                //todo 国际化
                'message' => $exception->getMessage()=='This action is unauthorized.'?'没有权限!':$exception->getMessage()
            ], 401);
        });
        $apiHandler->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response([
                'code' => 404,
                //todo 国际化
                'message' => $exception->getMessage()
            ], 404);
        });
        $this->app->singleton(Theme::class, function ($app) {
            return new Theme($app['filesystem']->disk('theme'), Setting::getSetting('current_theme'));
        });



    }
}
