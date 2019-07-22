<?php
namespace Karpovigorok\MonobankStatement;
use Illuminate\Support\ServiceProvider;

class MonobankStatementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('monobank.php'),
        ]);

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $view_path = $this->app['config']->get('monobank.view_path', '');
        $view_path = strlen($view_path)?$view_path:(__DIR__.'/views');
        if(!is_dir($view_path)) {
            throw new \Exception('Specified view directory ' . $view_path . ' doesn\'t exists.');
        }
        //var_dump();
        $this->loadViewsFrom($view_path, 'MonobankStatement');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'monobank'
        );

        $this->app->make('Karpovigorok\MonobankStatement\Controllers\MainpageController');

    }
}