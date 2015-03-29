<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SampleRepository;

/**
 * コマンドバスサンプルと、コンテナイベントが実装されているコントローラです。
 * コンテナイベントについては下記サービスプロバイダを参照してください
 * @see \App\Providers\AppServiceProvider
 *
 * Class BusController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class BusController extends Controller
{

    /**
     * uri : "/bus" [GET]
     * @param SampleRepository $sample
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(SampleRepository $sample, Request $request)
    {
        // \App\Commands\PushCommandへ実行を命令します
        // コマンドバスへリクエスト値をそのまま利用します
        $this->dispatchFrom('App\Commands\PushCommand', $request);
        return view('bus.index');
    }

}
