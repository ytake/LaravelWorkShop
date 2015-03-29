<?php
namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;

/**
 * rootディレクトリのコントローラ
 * このサンプルは登録・確認・実行の一般的なフォームです。
 * Class HomeController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class HomeController extends Controller
{

    /**
     * uri : "/" [GET]
     * @return string
     */
    public function getIndex()
    {
        return "home";
    }

    /**
     * フォーム登録画面
     * uri : "/form" [GET]
     * @return \Illuminate\View\View
     */
    public function getForm()
    {
        return view('form');
    }

    /**
     * フォーム確認画面
     * uri : "/confirm" [POST]
     * @param HomeRequest $home
     * @return \Illuminate\View\View
     */
    public function postConfirm(HomeRequest $home)
    {
        return view('confirm');
    }

    /**
     * フォーム実行画面
     * uri : "/apply" [POST]
     * @param HomeRequest $request
     * @return $this|\Illuminate\View\View
     */
    public function postApply(HomeRequest $request)
    {
        // 戻るボタンが押下されれば登録画面へ戻します
        if ($request->_return) {
            return redirect('/form')
                ->withInput($request->only('name'));
        }
        return view('apply');
    }

}
