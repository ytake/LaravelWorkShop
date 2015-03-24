# 簡単なアプリケーション開発

Laravel5で追加された機能を使い、まずは簡単なアプリケーションを作りながら進めましょう。  
今回もビルトインサーバで動かすので、apache, nginxなどのwebサーバは不要です  

#目次
[composerインストール](#composerインストール)
[Laravel5インストール](#Laravel5インストール)  
[helloLaravel](#hellolaravel)  
[はじめてのルーターLaravel5](#はじめてのルーターLaravel5)  
[はじめてのコントローラーLaravel5](#はじめてのコントローラーLaravel5)  
[はじめてのビューLaravel5](#はじめてのビューLaravel5)  
[はじめてのフォームリクエストLaravel5](#はじめてのフォームリクエストLaravel5)  
[はじめてのミドルウェアLaravel5](#はじめてのミドルウェアLaravel5)  

## composerインストール
```bash
$ curl -sS https://getcomposer.org/installer | php
```
curlが使用できない場合は、
```bash
$ php -r "readfile('https://getcomposer.org/installer');" | php
```
インストールするディレクトリを指定する場合は次の様に指定して下さい。  
```bash
$ curl -sS https://getcomposer.org/installer | php -- --install-dir=インストールしたいディレクトリ
```

すでに導入されている方は不要です。  
composer.pharへのパスを通します。  
```bash
# windowsの方はmove
$ mv composer.phar /usr/local/bin/composer(など任意の場所へ設置して下さい)
```
**不要の方は、/パス/composer.phpで利用して下さい。**

## Laravel5インストール

設置するディレクトリで以下の様にコマンドを実行して下さい  
```bash
#composerのパスを通している場合はこちら
$ composer create-project laravel/laravel プロジェクト名(英語で記述) --prefer-dist
#composerのパスを通していない場合は指定して実行して下さい
$ php /パス/composer.php create-project laravel/laravel プロジェクト名(英語で記述) --prefer-dist
```
**以降は$ php composer.pharではなく$ composerと記します**

##　実行権限
storage 配下にsessionやテンプレートのcacheファイル等が出力されるため、  
実行権限を与えて下さい
```bash
$ chmod -R 777 storage
```

composer.jsonで実行することも可能です。  
本番環境へのデプロイなどでも利用できますが、実行権限に注意してください。  
```json
"scripts": {
  "post-install-cmd": [
    "php artisan clear-compiled",
    "php artisan optimize",
    "chmod -R 777 storage"
  ]
}
```

インストールが完了すると、env.exampleが.envとしてコピーされて配置されます。  
サーバの環境変数などに記述しておけば、  
デプロイ時に同様にスクリプトを追加して、自動で環境に合う`.env` ファイルを作成することも可能です。  

最後に **config/app.php** のtimezoneを次の様に変更します。  

```php
    'timezone' => 'Asia/Tokyo',
```

## helloLaravel

ビルトインサーバを起動します
```bash
$ php artisan serve
```
デフォルトはlocalhost:8000で起動します。  
ポートを変更する場合は次の様にしましょう
```bash
$ php artisan serve --port 8888
```
またlocalhostではなく、任意のhostを指定する事もできます。  
```bash
$ php artisan serve --host 192.168.1.1 --port 8888
```

Laravel5 と表示されたら完了です。

## はじめてのルーターLaravel5
Laravel4のルータと同様です。  
これまで通りの記述法はHTTPメソッドに対応したルーティング、  
namespaceやprefixなどを利用したグループ化、  
リソースコントローラー、  
コントローラーのメソッドのprefixをHTTPメソッドに対応させたルーティングが選択できます。  
ルーティングファイルの肥大化が好みでなければアノテーションを利用するルーティングを使うことも可能です。  
5開発時に存在していたルーティングのひとつで、現在は有志によるメンテナンスへと切り替えられ、  
composerでインストールすることが可能です。  
[アノテーションを利用するルーティング](http://laravelcollective.com/docs/5.0/annotations)

app/Http/router.phpを以下の様に変更してみて下さい  
```php
\Route::get('/', function() {
    return "Hello Laravel!";
});
```
serveで起動したアドレスにアクセスしてください  
表示されましたか？
getとはHTTPのGETを指します  
getをpostに変更してみて下さい  
```php
\Route::post('/', function() {
    return "Hello Laravel!";
});
```
Exceptionが投げられたはずです。  
同様にput, patch, delete 等が指定できます。  
もう少し触ってみましょう。  
今度はLaravelの文字をuriで変更します  
```php
\Route::get('/{name?}', function($name = 'Laravel!') {
    return "Hello {$name}";
});
```
セグメントで指定していない場合は、先ほどと同じですが、  
任意の文字を入れてアクセスしてみて下さい  
**例 http://localhost:8000/world**  

?をつける事でnullが許容され、functionで指定された初期値が代入されます  
クエリーで値を受け取りたい時は、次の様にします。  
```php
\Route::get('/', function() {
    $name = \Input::get('name', "Laravel!");
    return "Hello {$name}";
});
```
http://localhost:8000にアクセスするとそのままで何も変わりません  
http://localhost:8000/?name=world としてアクセスするとnameが反映されます  
**\Input::get()は、$_GETでも$_POSTでも特に区別する事なく値を取得します**  
**$_FILESは\Input::file()！**  
第二引数でデフォルト値を設定できます  

今設定されているルーターの情報は
```bash
$ php artisan route:list
```
で確認できます  

ここまでがLaravel4と同様です。  
Laravel5で追加されたものに置き換えてみましょう。  

### GET
```php
get('/', function () {
    return "Hello Laravel!";
});
```
### POST
```php
post('/', function () {
    return "Hello Laravel!";
});
```
同様にdelete, put, patchがあります。  

###routerとview
bladeテンプレートを使って同じ事をしてみましょう  
app/resources/index.blade.phpを作成してください  
中身は次の様にします

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$name}}</title>
</head>
<body>
    Hello {{$name}}
</body>
</html>
```
router.phpは先ほどものを以下の様に変更します  
```php
\Route::get('/', function() {
    return view('index')->with('name', \Input::get('name', "Laravel!"));
    // name以外のものも同時に渡したい場合は
    // return view('index')->with('name', \Input::get('name', "Laravel!"))->with('hoge', 'hoge');
});
```
次の様に書く事もできます  
```php
\Route::get('/', function() {
    $array = [
        'name' => \Input::get('name', "Laravel!")
        // 配列に追加
    ];
    return view('index', $array);
});
```
コントローラー要らずで、小さいアプリケーション等はこれだけでも十分実装できます

##はじめてのコントローラーLaravel5
Laravel5の新機能を利用するため、以下の簡単なコントローラを作成します。

```php
namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function getForm()
    {

    }

    public function postConfirm()
    {

    }

    public function postApply()
    {

    }

}
```

今回ルーティングで利用するのは prefixをHTTPメソッドに対応させたコントローラルーティングです。
routes.phpには以下のように記述します。  

```php
\Route::controller("/", "HomeController");
```

`App\Http\Controllers`は、`RouteServiceProvider`ですでに記述されていますので書きません。  
Laravel4のアプリケーションを移行する場合は、  
```php
protected $namespace = null;
```
としてください。

```bash
$ php artisan route:list
```
ルーティングが作成されたことを確認しましょう。

##はじめてのビューLaravel5
コントローラーの用意できたら、対応するメソッドと簡単なテンプレートを作成します。

入力画面
```php
/**
 * @return mixed
 */
public function getForm()
{
    return view('form');
}
```
URLは http://localhost:8000/form です

ビューはレイアウト用のファイルを作り、継承して利用するようにします
**resources/views/layouts/default.blade.php** として作成します
```php
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
```
テンプレートのレイアウトファイルとなります。

テンプレートの継承は以下のようになります
```php
@extends('layouts.default')
@section('content')
hello
@stop
```

**resources/views/form.blade.php** を作成して以下のような簡単なフォームを作成します。
```php
@extends('layouts.default')
@section('content')
<form method="POST" action="{{action('HomeController@postConfirm')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="text" name="name" id="name" value="{{Input::old('name')}}">
    <button type="submit">confirm</button>
</form>
@stop
```

続いて確認画面です
```php
/**
 * @return mixed
 */
public function postConfirm()
{
    return view('confirm');
}
```
**resources/views/confirm.blade.php** は以下のようにします。
```php
@extends('layouts.default')
@section('content')
    <form method="POST" action="{{action('HomeController@postApply')}}">
        <input type="hidden" name="_token" value="{{Input::get('_token')}}">
        <input type="hidden" name="name" value="{{Input::get('name')}}">
        {{Input::get('name')}}
        <input name="_return" type="submit" value="return">
        <input name="_apply" type="submit" value="apply">
    </form>
@stop
```

最後に実行画面です
```php
/**
 * @return mixed
 */
public function postApply()
{
    return view('apply');
}
```

**resources/views/apply.blade.php** は以下のようにします。
```php
@extends('layouts.default')
@section('content')
complete!
@stop
```

submitでそれぞれのフォームへ遷移されることを確認しましょう！
値がない場合でも登録できるようになっていますので、バリデートなどの処理を記述してきます。

##はじめてのフォームリクエストLaravel5
バリデートなどの処理はLaravel5から追加されたフォームリクエストを利用して簡単に実装することができます。
下記のコマンドでファイルを作成します
```bash
$ php artisan make:request HomeRequest
```

**app/Http/Request/HomeRequest.php** としてファイルが作成されます。
```php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class HomeRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
```
作成されたファイルのうち、変更するのは *authorize* メソッドです。  
このメソッドは認証済みかどうかで動作を変更することができます。  
作成された状態のままではfalseとなり、認証されていないユーザーは遷移ができない状態になりますので、  
trueへ変更します。  

バリデートのルールは`rule`メソッドに記述します。  
```php
public function rules()
{
    return [
        'name' => 'required'
    ];
}
```

先ほどのform.blade.phpに
```php
{{$errors->first('name')}}
```
を追記して、バリデートエラーが表示されるのを確認しましょう！  

バリデートメッセージはlangディレクトリで多言語対応ファイルを追加するか、  
フォームリクエストで簡単に変更することができます。  

`messages`メソッドを追加します。
```php
/**
 * @return array
 */
public function messages()
{
    return [
        'name.required' => ':attributeを入力してください'
    ];
}
```
任意の文字が表示されることを確認しましょう。  

最後に、登録画面へ戻す場合の動作を追記します。  

```php
/**
 * @return mixed
 */
public function postApply(HomeRequest $request)
{
    if($request->'_return') {
        return redirect('/form')
            ->withInput($request->only('name'));
    }
    \Session::forget('_token');
    return view('apply');
}
```
リクエストクラスは、配列またはオブジェクトでアクセスすることができます。  
これでフォームの一連の動きができました

##はじめてのミドルウェア
