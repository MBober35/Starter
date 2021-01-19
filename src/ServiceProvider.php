<?php

namespace MBober35\Starter;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;
use MBober35\Starter\Commands\GenerateLoginLink;
use MBober35\Starter\Commands\StarterCommand;
use MBober35\Starter\Helpers\LoginGeneratorManager;

class ServiceProvider extends BaseProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Команды.
        if ($this->app->runningInConsole()) {
            $this->commands([
                StarterCommand::class,
            ]);
        }
        $this->commands([
            GenerateLoginLink::class,
        ]);

        // Facades.
        $this->app->singleton("login-generator", function () {
            return new LoginGeneratorManager;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::mixin(new AuthRouteMethods);

        // Подключение шаблонов.
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'mbober-starter');

        Paginator::useBootstrap();

        // Миграции.
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Адреса.
        $this->loadRoutesFrom(__DIR__ . '/routes/login.php');
    }
}
