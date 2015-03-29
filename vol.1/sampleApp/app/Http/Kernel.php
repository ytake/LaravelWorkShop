<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * アプリケーション ミドルウェアクラス
 * Class Kernel
 * @package App\Http
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Kernel extends HttpKernel
{

    /**
     * グローバルで作用するミドルウェアを追加など
     * シングルページアプリケーションや、APIなどでセッションなどが不要な場合は
     * 利用しないミドルウェアを削除することでパフォーマンスを向上させることが可能です。
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'App\Http\Middleware\VerifyCsrfToken',
        'App\Http\Middleware\GlobalMiddleware'
    ];

    /**
     * ルーティングで動作させるミドルウェアの追加など
     * ミドルウェアに名前をつけ、ルーティングで指定します
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'App\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
        'home' => 'App\Http\Middleware\HomeMiddleware'
    ];

}
