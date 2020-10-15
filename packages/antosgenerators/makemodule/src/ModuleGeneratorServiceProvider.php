<?php

namespace AntosGenerators\ModuleGenerator;

use Illuminate\Support\ServiceProvider;
use App;
class ModuleGeneratorServiceProvider extends ServiceProvider
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
        $this->app->singleton('command.antosgenerators.makemodule', function ($app) {
            return $app['AntosGenerators\ModuleGenerator\Commands\ModuleMakeCommand'];
        });
        $this->commands('command.antosgenerators.makemodule');

    }

}