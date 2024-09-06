<?php

namespace Modules\User\app\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
        $this->app->register(RouteServiceProvider::class);
    }
}
