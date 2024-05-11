<?php

namespace App\Providers;

use App\Application\UseCases\FindDepartamentUseCase;
use App\Application\UseCases\FindDistrictUseCase;
use App\Application\UseCases\FindProvinceUseCase;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\UbigeoRepositoryInterface;
use App\Infrastructure\Adapters\EloquentClientRepository;
use App\Infrastructure\Adapters\EloquentUbigeoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientRepositoryInterface::class, EloquentClientRepository::class);
        $this->app->bind(UbigeoRepositoryInterface::class, EloquentUbigeoRepository::class);

        $this->app->bind(FindDepartamentUseCase::class, function ($app) {
            return new FindDepartamentUseCase($app->make(UbigeoRepositoryInterface::class));
        });
        $this->app->bind(FindDistrictUseCase::class, function ($app) {
            return new FindDistrictUseCase($app->make(UbigeoRepositoryInterface::class));
        });
        $this->app->bind(FindProvinceUseCase::class, function ($app) {
            return new FindProvinceUseCase($app->make(UbigeoRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
