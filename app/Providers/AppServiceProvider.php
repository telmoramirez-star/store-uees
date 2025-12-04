<?php

namespace App\Providers;

use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aqui registramos los servicios y repositorios
        $this->app->singleton(UserRepository::class);
        $this->app->singleton(UserService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
