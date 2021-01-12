<?php

namespace MBober35\Starter;

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
        //
    }
}
