<?php
namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class HomeController extends Controller
{

    /**
     * @return string
     */
    public function getIndex()
    {
        return "home";
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getForm()
    {
        return view('form');
    }

    /**
     * @param HomeRequest $home
     * @return \Illuminate\View\View
     */
    public function postConfirm(HomeRequest $home)
    {
        return view('confirm');
    }

    /**
     * @param HomeRequest $request
     * @return $this|\Illuminate\View\View
     */
    public function postApply(HomeRequest $request)
    {
        if ($request->_return) {
            return redirect('/form')
                ->withInput($request->only('name'));
        }
        return view('apply');
    }

}
