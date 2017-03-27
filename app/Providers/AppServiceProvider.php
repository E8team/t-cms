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

        $this->app->singleton(Theme::class, function ($app) {
            return new Theme($app['filesystem']->disk('theme'), Setting::getSetting('current_theme'));
        });
    }
}
