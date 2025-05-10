<?php

namespace App\Providers;

use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\SubCategoryRepository;
use App\Repository\IncomingGoodsRepository;
use App\Repository\IncomingGoodsDetileRepository;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use App\Repository\Interfaces\SubCategoryRepositoryInterfaces;
use App\Repository\Interfaces\IncomingGoodsRepositoryInterfaces;
use App\Repository\Interfaces\IncomingGoodsDetileRepositoryinterfaces;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterfaces::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterfaces::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterfaces::class, SubCategoryRepository::class);
        $this->app->bind(IncomingGoodsRepositoryInterfaces::class, IncomingGoodsRepository::class);
        $this->app->bind(IncomingGoodsDetileRepositoryinterfaces::class, IncomingGoodsDetileRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
