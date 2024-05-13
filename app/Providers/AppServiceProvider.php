<?php

namespace App\Providers;

use App\Application\UseCases\Client\CreateClientUseCase;
use App\Application\UseCases\Client\FindClientByIdUseCase;
use App\Application\UseCases\Client\FindClientUseCase;
use App\Application\UseCases\Deposit\FindDepositUseCase;
use App\Application\UseCases\Deposit\RecargarDepositUseCase;
use App\Application\UseCases\Deposit\UpdateRecargaDepositUseCase;
use App\Application\UseCases\General\ComunicationUseCase;
use App\Application\UseCases\General\FindComunicationUseCase;
use App\Application\UseCases\General\FindRoleUseCase;
use App\Application\UseCases\General\UpdateStatusComunicationUseCase;
use App\Application\UseCases\SalesConsultant\CreateSalesConsultantUseCase;
use App\Application\UseCases\SalesConsultant\FindSalesConsultantByIdUseCase;
use App\Application\UseCases\SalesConsultant\FindSalesConsultantUseCase;
use App\Application\UseCases\Ubigeo\FindDepartamentUseCase;
use App\Application\UseCases\Ubigeo\FindDistrictUseCase;
use App\Application\UseCases\Ubigeo\FindProvinceUseCase;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\DepositRepositoryInterface;
use App\Domain\Repositories\GeneralRepositoryInterface;
use App\Domain\Repositories\SalesConsultantRepositoryInterface;
use App\Domain\Repositories\UbigeoRepositoryInterface;
use App\Domain\Repositories\UsersRepositoryInterface;
use App\Infrastructure\Adapters\EloquentClientRepository;
use App\Infrastructure\Adapters\EloquentDepositRepository;
use App\Infrastructure\Adapters\EloquentGeneralRepository;
use App\Infrastructure\Adapters\EloquentSalesConsultantRepository;
use App\Infrastructure\Adapters\EloquentUbigeoRepository;
use App\Infrastructure\Adapters\EloquentUsersRepository;
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
        $this->app->bind(SalesConsultantRepositoryInterface::class, EloquentSalesConsultantRepository::class);
        $this->app->bind(UbigeoRepositoryInterface::class, EloquentUbigeoRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, EloquentUsersRepository::class);
        $this->app->bind(GeneralRepositoryInterface::class, EloquentGeneralRepository::class);
        $this->app->bind(DepositRepositoryInterface::class, EloquentDepositRepository::class);

        $this->app->bind(CreateClientUseCase::class, function ($app) {
            return new CreateClientUseCase($app->make(ClientRepositoryInterface::class));
        });
        $this->app->bind(FindClientUseCase::class, function ($app) {
            return new FindClientUseCase($app->make(ClientRepositoryInterface::class));
        });
        $this->app->bind(FindClientByIdUseCase::class, function ($app) {
            return new FindClientByIdUseCase($app->make(ClientRepositoryInterface::class));
        });
        
        // Asesores de ventas
        $this->app->bind(CreateSalesConsultantUseCase::class, function ($app) {
            return new CreateSalesConsultantUseCase($app->make(SalesConsultantRepositoryInterface::class));
        });
        $this->app->bind(FindSalesConsultantUseCase::class, function ($app) {
            return new FindSalesConsultantUseCase($app->make(SalesConsultantRepositoryInterface::class));
        });
        $this->app->bind(FindSalesConsultantByIdUseCase::class, function ($app) {
            return new FindSalesConsultantByIdUseCase($app->make(SalesConsultantRepositoryInterface::class));
        });

        // FUNCIONES GENERALES

         $this->app->bind(ComunicationUseCase::class, function ($app) {
            return new ComunicationUseCase($app->make(GeneralRepositoryInterface::class));
        });
        $this->app->bind(FindComunicationUseCase::class, function ($app) {
            return new FindComunicationUseCase($app->make(GeneralRepositoryInterface::class));
        });
        $this->app->bind(UpdateStatusComunicationUseCase::class, function ($app) {
            return new UpdateStatusComunicationUseCase($app->make(GeneralRepositoryInterface::class));
        });
        $this->app->bind(FindRoleUseCase::class, function ($app) {
            return new FindRoleUseCase($app->make(GeneralRepositoryInterface::class));
        });
        
       
        // Deposito
        $this->app->bind(RecargarDepositUseCase::class, function ($app) {
            return new RecargarDepositUseCase($app->make(EloquentDepositRepository::class));
        });
        $this->app->bind(UpdateRecargaDepositUseCase::class, function ($app) {
            return new UpdateRecargaDepositUseCase($app->make(EloquentDepositRepository::class));
        });
        $this->app->bind(FindDepositUseCase::class, function ($app) {
            return new FindDepositUseCase($app->make(EloquentDepositRepository::class));
        });
        
        
        

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
