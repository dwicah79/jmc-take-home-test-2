<?php

namespace App\Providers;

use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Interfaces\UserRepositoryInterfaces;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterfaces::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
