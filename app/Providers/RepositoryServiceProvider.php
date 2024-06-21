<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Government\GovernmentRepository;
use App\Interfaces\Government\GovernmentRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GovernmentRepositoryInterface::class , GovernmentRepository::class );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
