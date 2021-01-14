<?php

namespace MBober35\Starter;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;
use MBober35\Starter\Commands\StarterCommand;

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
    }
}
