<?php

namespace App\Providers;

use App\Models\Setting;
use App\T\Alert\Alert;
use App\T\Navigation\Navigation;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Ty666\LaravelTheme\Theme;

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
            \Log::info('sql', [$query->sql
                , $query->bindings
                , $query->time]);
        });

        $this->registerCustomValidator();
        // 获取当前主题
        $theme = app(Theme::class);
        if (!is_null($currentTheme = Setting::getSetting('current_theme'))) {
            $theme->setCurrentTheme($currentTheme);
        }
    }

    public function registerCustomValidator()
    {
        Validator::extend('picture_id', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[0-9a-z]{32}/i', $value) == 1;
        }, '图片上传错误!');
        Validator::extend('int_array', function ($attribute, $value, $parameters, $validator) {
            if (!is_array($value))
                return false;
            foreach ($value as $v)
                if (!is_numeric($v))
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
        $this->registerDingoApiExceptionHandler();

        $this->app->singleton(Navigation::class, function () {
            return new Navigation();
        });

        $this->app->singleton(Alert::class, function ($app) {
            $defaultConfig = [
                'default_type' => 'info',
                'default_has_button' => false,
                'default_need_container' => true,
                'allow_type_list' => [
                    'info', 'success', 'warning', 'danger'
                ]
            ];
            $config = array_merge($defaultConfig, $app->make('config')['alert']);
            return new Alert($app->make('session.store'), $config);
        });
    }


    public function registerDingoApiExceptionHandler()
    {
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
                'message' => $exception->getMessage() == 'This action is unauthorized.' ? trans('message.no_permission') : $exception->getMessage()
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
        $apiHandler->register(function (QueryException $exception) {
            if ($this->app->environment() !== 'production') {
                //throw new HttpException(500, $exception->getSql());
                throw $exception;
            } else {
                // todo log
                throw new HttpException(500);
            }
        });
    }
}
