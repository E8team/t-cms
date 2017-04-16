<?php

namespace App\Providers;

use App\Entities\Setting;
use App\Libs\Theme;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

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
        Validator::extend('int_array', function($attribute, $value, $parameters, $validator) {
            if(!is_array($value))
                return false;
            foreach($value as $v)
                if(!is_numeric($v))
                    return false;

            return true;
        }, ':attribute 必须为数字数组');
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
            $this->app->register(\Clockwork\Support\Laravel\ClockworkServiceProvider::class);
        }

        $apiHandler = app('Dingo\Api\Exception\Handler');
        $apiHandler->register(function (\Illuminate\Auth\AuthenticationException $exception) {
            return response([
                'code' => 401.1,
                'message' => trans('auth.please_login_first')
            ], 401);
        });
        $apiHandler->register(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            return response([
                'code' => 401.3,
                'message' => $exception->getMessage()=='This action is unauthorized.'?trans('message.no_permission'):$exception->getMessage()
            ], 401);
        });
        $apiHandler->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response([
                'code' => 404,
                //todo 这里的错误显示需要处理
                'message' => $exception->getMessage()
            ], 404);
        });
        $apiHandler->register(function (ValidationException $exception) {

            throw new ValidationHttpException($exception->validator->errors());
        });

    }
}
