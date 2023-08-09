<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\SupplierRepository;
use App\Repositories\IssueItemRepository;
use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\RequisitionRepository;
use App\Repositories\ReceivedItemRepository;
use App\Interfaces\SupplierRepositoryInterface;
use App\Interfaces\IssueItemRepositoryInterface;
use App\Interfaces\RequisitionRepositoryInterface;
use App\Interfaces\ReceivedItemRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(ReceivedItemRepositoryInterface::class, ReceivedItemRepository::class);
        $this->app->bind(RequisitionRepositoryInterface::class, RequisitionRepository::class);
        $this->app->bind(IssueItemRepositoryInterface::class, IssueItemRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
