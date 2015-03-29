<?php
namespace App\Http\Requests;

/**
 * 本サンプルで利用しているミドルウェアです
 *
 * Class HomeRequest
 * @package App\Http\Requests
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class HomeRequest extends Request
{

    /**
     * バリデーションエラーで遷移するURIを指定することができます
     * @var string
     */
    protected $redirect;

    /**
     * バリデーションエラーで遷移する名前付きルーティングを指定することができます
     * @var string
     */
    protected $redirectRoute;

    /**
     * バリデーションエラーで遷移するコントローラ(コントローラクラス@メソッド)を指定することができます
     * @var string
     */
    protected $redirectAction;

    /**
     * バリデーションエラー時の遷移先決定の優先度は、
     * 1.URI
     * 2.名前付きルーティング
     * 3.コントローラクラス@メソッド
     * 指定がなければ単純に前の画面へ戻します
     */

    /**
     * ユーザー認証が必要かどうかで遷移させるかどうかを決定することができます。
     * abstractメソッドではないため、削除することもできますが、
     * その場合はfalseが返却されるため、遷移ができません。
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルールを記述します。
     * 用意されているバリデーションについてはマニュアルを参照してください。
     * カスタムバリデートルールについても同様にマニュアルを参照していただくか、
     * 以前Qiitaに投稿したバリデーションルールの実装方法がありますので、そちらを参照してください
     * @see http://qiita.com/ytake/items/60c772ca52fb868a5cbd
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * エラー時に返却されるメッセージを指定することができます。
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => ':attributeを入力してください'
        ];
    }

    /**
     * リダイレクトではなく、任意のレスポンスを返却したい場合は、
     * responseメソッドをオーバライドして任意の動作を実装することができます。
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     *
    public function response(array $errors)
    {
        return new \Illuminate\Http\JsonResponse($errors, 403);
    }
    */
}
