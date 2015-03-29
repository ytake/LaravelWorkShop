<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

/**
 * ログインしていないユーザがホーム画面へ遷移されるミドルウェアです。
 * 本サンプルでは利用していません
 *
 * Class RedirectIfAuthenticated
 * @package App\Http\Middleware
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class RedirectIfAuthenticated
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            return new RedirectResponse(url('/home'));
        }

        return $next($request);
    }

}
