<?php

namespace App\Providers;

use App\Repositories\Builders\OrderBuilder;
use App\Repositories\Builders\OrderBuilderInterface;
use App\Repositories\Builders\QueryBuilder;
use App\Repositories\Builders\QueryBuilderInterface;
use App\Repositories\EloquentProfileRepository;
use App\Repositories\Repository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            QueryBuilderInterface::class,
            QueryBuilder::class
        );
        $this->app->bind(
            OrderBuilderInterface::class,
            OrderBuilder::class
        );
        $this->app->bind(
            Repository::class,
            EloquentProfileRepository::class
        );
    }
}
