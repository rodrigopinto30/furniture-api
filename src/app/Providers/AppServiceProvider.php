<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Interfaces
use App\Interfaces\MuebleRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;

// Implementaciones
use App\Repositories\MuebleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MuebleRepositoryInterface::class, MuebleRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
