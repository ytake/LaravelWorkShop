<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ConfigServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ConfigServiceProvider extends ServiceProvider
{

    /**
     * Overwrite any vendor / package configuration.
     *
     * This service provider is intended to provide a convenient location for you
     * to overwrite any "vendor" or package configuration that you may want to
     * modify before the application handles the incoming request / command.
     *
     * @return void
     */
    public function register()
    {
        // 特定の環境時にのみ有効になるような処理を定義することができます。
        if ($this->app->environment("local")) {
            // この場合は`local`環境時にのみ ide_helper生成が可能です
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
        }
        config([
            //
        ]);
    }

}
