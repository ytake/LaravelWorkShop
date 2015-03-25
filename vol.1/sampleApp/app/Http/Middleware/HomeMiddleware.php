<?php
namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
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
        if(!is_null(\Route::input('one'))) {
            throw new AccessDeniedHttpException;
        }
        return $next($request);
    }

}
