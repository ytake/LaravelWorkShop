<?php
namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * ルーティングミドルウェアとして登録した例です。
 *
 * Class HomeMiddleware
 * @package App\Http\Middleware
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class HomeMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // コントローラの前で実行されます
        if(!is_null(\Route::input('one'))) {
            // urlのセグメントに余分な引数が指定されている場合に動作します。
            throw new AccessDeniedHttpException;
        }
        $middleware = $next($request);
        // コントローラの後で実行されます
        return $middleware;
    }

}
