<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event as LaravelEvent;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //実行されるevent出力
        LaravelEvent::listen('*', function() {
           // var_dump(LaravelEvent::firing());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // abstract concrete bindings
        $this->app->bind(
            'App\Services\SampleServiceInterface',
            'App\Services\SampleService'
        );

        /*
        // コンストラクタインジェクションなどで解決されない引数を渡す
        $this->app->instance('name', 'sample');
        $this->app->bind('App\Services\SampleServiceInterface', function ($app) {
            return $app->make('App\Services\SampleService', [app('name')]);
        });
        */
        // singleton
        $this->app->singleton(
            'App\Services\SingletonServiceInterface',
            'App\Services\SingletonService'
        );
        // contextual binding
        $this->app->when('App\Http\Controllers\FormulaController')
            ->needs('App\Engines\EngineInterface')
            ->give('App\Engines\Formula');
        $this->app->when('App\Http\Controllers\RallyController')
            ->needs('App\Engines\EngineInterface')
            ->give('App\Engines\Rally');
        //
        $this->app->resolving("App\Repositories\SampleRepository", function($app) {
            $app->setObject(new \StdClass);
            $this->app->call([$app, 'start']);
            info("call start method");
        });
    }
}
