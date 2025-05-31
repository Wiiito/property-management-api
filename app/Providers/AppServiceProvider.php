<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\OwnerRepositoryInterface;
use App\Repositories\EloquentORM\OwnerEloquentORM;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(OwnerRepositoryInterface::class, OwnerEloquentORM::class);
    }
}
