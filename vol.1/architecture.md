#Laravel5新機能

Laravel5で追加された機能を触っていきましょう。  
ここからはサンプルアプリケーションを実行しながら解説していきます。  

##サービスコンテナのおさらい
基本的なコンテナの機能のおさらいです。  
下記のものはいずれもコンストラクタインジェクションや、インスタンス生成で利用できます  
**app/Providers/AppServiceProvider.php**  
###インターフェースとのバインディング
```php
$this->app->bind(
    'App\Services\SampleServiceInterface',
    'App\Services\SampleService'
);
```

テストなどでモックと差し変えたり、実装が変更される場合に、  
具象クラスのみを差し替えることによりアプリケーションに柔軟性と拡張性を与えます。  
http://localhost:8000/v1/api へアクセスしてみましょう。

空のjsonが返却されます。  
クラスを入れ替えます。  
```php
$this->app->bind(
    'App\Services\SampleServiceInterface',
    'App\Services\SampleTwoService'
);
```

###singleton
```php
$this->app->singleton(
    'App\Services\SingletonServiceInterface',
    'App\Services\SingletonService'
);
```
コンテナがインスタンスを保持します。  
ApiControllerのコメントアウトを外して実行してみましょう。  

###コンストラクタへ
コンテナで解決されない引数を渡す場合や、一般的なライブラリなどはこのようにして使用することもできます。  
```php
$this->app->bind('App\Services\SampleServiceInterface', function ($app) {
    return $app->make('App\Services\SampleService', ['sample']);
});
```

##contextual binding
これまでインターフェースと具象グラスのバインディングはそれぞれ1対1の関係でしたが、  
Laravel5から追加されたバインディングは、同一のインターフェースを複数のクラスで利用することができます。  

**app/Providers/AppServiceProvider.php**  
```php
$this->app->when('App\Http\Controllers\FormulaController')
    ->needs('App\Engines\EngineInterface')
    ->give('App\Engines\Formula');
$this->app->when('App\Http\Controllers\RallyController')
    ->needs('App\Engines\EngineInterface')
    ->give('App\Engines\Rally');
```
同一のインターフェースを複数のコントローラで指定します。  
http://localhost:8000/f1  
http://localhost:8000/wrc  

メソッドインジェクションでは解決されません。  

##コンテナイベント
コンテナのイベントを利用して、様々な処理を割り込ませることができます。  
この例では `App\Repositories\SampleRepository` クラスが注入されるときに、  
stdClassのオブジェクトをセットし、`start`メソッドを実行して、ログに書き込みます。  
callメソッドはメソッドインジェクションを解決することができるメソッドです。

**app/Http/Controllers/BusController.php**  
```php
$this->app->resolving("App\Repositories\SampleRepository", function($app) {
    $app->setObject(new \StdClass);
    $this->app->call([$app, 'start']);
    info("call start method");
});
```
フォームリクエストはこのしくみを利用して実装されています。

##コマンドバス
Laravel5からコマンドバスが追加されました。  
5.1では名前が変わるかも・・？  
コントローラや、その他様々なクラスやレイヤでの実装で、  
複雑な処理をさせたりする上でそれらの処理をコマンドとしてカプセル化するしくみです。  
お使いのOSの様々なメニューなどを押した時の処理のようなものと考えるといいかもしれません。  

コマンドバスはQueueと組み合わせることで非同期で処理を行うことができます。  
Eventも同様にQueueと組み合わせることができます。  
コマンドバスはイベントのようにオブザーバのパターンではありませんので、用途によって使い分ける必要があります。  

コマンドクラスは次のコマンドで作成します。  
```bash
$ php artisan make:command PushCommand
```

コマンドバスを利用してログを書き込む簡単な実装をしてみましょう。  
**BusController.php** のindexを利用します。  

dispatchメソッドはトレイトです
```php
public function index(SampleRepository $sample, Request $request)
{
    $this->dispatchFrom('App\Commands\PushCommand', $request);
    return view('bus.index');
}
```

`bus?message=aaa`のようにアクセスするとコマンドクラスへ渡されます。  
dispatchメソッドは用途に合わせて使い分けましょう！  

```php
class PushCommand extends Command implements SelfHandling
{

    /** @var string  */
    protected $message;

    /**
     * @param string $message
     */
    public function __construct($message = "hello")
    {
        $this->message = $message;
    }

    /**
     * @return void
     */
    public function handle()
    {
        info($this->message);
    }

}
```

**Illuminate\Contracts\Queue\ShouldBeQueued** インターフェースを実装すると、  
Queueを利用して非同期で処理を行うことができます。  
メール送信をしたり課金処理や、websocketへの通知など様々なケースで利用できるでしょう！  

##ファイルシステム(ストレージ)
awsなどを利用することが簡単になりました。  
dropboxやftpといったものを実装することもできます。  
利用する場合は、aws/aws-sdk-php, league/flysystem-aws-s3-v2 をインストールしてください

##スケジュール
Laravelでそれぞれのartisanコマンドの実行時間を操作することができます。  

##laravel-elixir
タスクのサンプルを紹介します。
