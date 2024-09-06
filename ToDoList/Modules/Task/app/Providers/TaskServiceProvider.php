<?php

namespace Modules\Task\app\Providers;



use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
        $this->app->register(RouteServiceProvider::class);
    }
}
