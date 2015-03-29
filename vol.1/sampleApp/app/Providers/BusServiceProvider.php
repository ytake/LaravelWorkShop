<?php
namespace App\Providers;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

/**
 * Class BusServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class BusServiceProvider extends ServiceProvider
{

    /**
     * コマンドバスのコマンド送信クラス、受信クラスとのマッピングを変更することができます
     * Bootstrap any application services.
     *
     * @param  \Illuminate\Bus\Dispatcher $dispatcher
     * @return void
     */
    public function boot(Dispatcher $dispatcher)
    {
        $dispatcher->mapUsing(function ($command) {
            return Dispatcher::simpleMapping(
                $command, 'App\Commands', 'App\Handlers\Commands'
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
