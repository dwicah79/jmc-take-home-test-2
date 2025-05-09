<?php

namespace App\Providers;

use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterfaces::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterfaces::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
