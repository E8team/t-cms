<?php

namespace App\Providers;

use App\Repositories\CachePageRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(
            PostRepository::class, function () {
                return new PostRepository();
            }
        );

        $this->app->singleton(
            CategoryRepository::class, function () {
                return new CategoryRepository();
            }
        );

        $this->app->singleton(
            UserRepository::class, function () {
                return new UserRepository();
            }
        );

        $this->app->singleton(
            CachePageRepository::class, function () {
            return new CachePageRepository();
        }
        );
    }
}
