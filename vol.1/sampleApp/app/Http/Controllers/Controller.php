<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
abstract class Controller extends BaseController
{

	use DispatchesCommands, ValidatesRequests;

    /**
     * デフォルトで用意されているこのコントローラーには、
     * コマンドバス実装用のトレイト、
     * フォームリクエスト通過後にバリデートを簡単に実行できるようにバリデートトイレトが含まれています。
     */
}
