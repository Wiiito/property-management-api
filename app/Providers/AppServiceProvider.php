<?php

namespace App\Providers;

use App\Repositories\EloquentORM\PropertyEloquentORM;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\OwnerRepositoryInterface;
use App\Repositories\EloquentORM\OwnerEloquentORM;
use App\Repositories\EloquentORM\PropertyStatisticsEloquentORM;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use App\Repositories\Interfaces\PropertyStatisticsRepositoryInterface;

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
        $this->app->bind(PropertyRepositoryInterface::class, PropertyEloquentORM::class);
        $this->app->bind(PropertyStatisticsRepositoryInterface::class, PropertyStatisticsEloquentORM::class);
    }
}
