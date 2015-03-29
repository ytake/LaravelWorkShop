<?php
namespace App\Http\Middleware;

use Closure;

/**
 * グローバルミドルウェアとして登録した例です。
 * 実装はありません
 *
 * Class GlobalMiddleware
 * @package App\Http\Middleware
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class GlobalMiddleware
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
        $middleware = $next($request);
        // コントローラの後で実行されます
        return $middleware;
    }

}
