<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
class HelperServiceProvider extends ServiceProvider
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
        require_once app_path('Helpers/Helper.php');
        // App::bind('helper', function()
        // {
        //     return new \App\Anto\Helper;
        // });
    }
}
