<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * エラーハンドリングクラス
 *
 * Class Handler
 * @package App\Exceptions
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Handler extends ExceptionHandler
{

    /**
     * エラーログに残さなくて良いエクセプションを追加することができます
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ];

    /**
     * レポート時の動作を任意の動作に変更することができます
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * エラー処理によってレスポンスを変更することができます。
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // 通常は$e->getCode() エラーコードに紐付いた
        // "resources/views/errors" ディレクトリ配下のテンプレートが利用されますが、
        // 任意のレスポンスに変更することができます
        if($e instanceof AccessDeniedHttpException) {
            return response("余計な引数があります", 400);
        }
        return parent::render($request, $e);
    }

}
