<?php

namespace App\Providers;

use App\Service\EventService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

}
