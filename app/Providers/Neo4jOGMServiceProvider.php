<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GraphAware\Neo4j\OGM\EntityManager;

class Neo4jOGMServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EntityManager::class, function ($app) {
            return EntityManager::create(config('database.neo4j-url'));
        });
    }
}
