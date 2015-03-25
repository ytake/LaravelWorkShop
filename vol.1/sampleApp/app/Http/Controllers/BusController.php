<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SampleRepository;

/**
 * Class BusController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class BusController extends Controller
{

    public function index(SampleRepository $sample, Request $request)
    {
        $this->dispatchFrom('App\Commands\PushCommand', $request);
        return view('bus.index');
    }

}
