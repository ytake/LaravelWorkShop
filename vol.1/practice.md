# 実務でのポイント

##config, route編
###config:cache
新しく追加された、コンフィグキャッシュを使ってスピードアップ！
```bash
$ php artisan config:cache
```

###route:cache
そこまで大きな差にはなりませんが、アクセスが増えてくると少しづつ効いてきます。
```bash
$ php artisan route:cache
```

###optimize
フレームワークやユーザーが実装したクラスを一つのファイルにします。  
```bash
$ php artisan optimize --force
```
実装したクラスを含める場合は、**config/compile.php** へ追加しましょう！

##実装編
###コンパクトな小さいアプリはMVC
小さなアプリケーションではいろいろ要求されることは少ないはずです。  
一番簡単に実装できる、controller, View, Model(Eloquent) のベーシックなものでやりましょう！

###複数人開発では非MVC推奨
といってもベースはMVCです。  
ただし複数人で行う場合に、どうしてもスパゲッティになりがちです。  

```php
class Controller
{

  protected $user_id;

  public function __construct()
  {
    $this->user_id = \Route::input('id');
    $this->store_id = \Route::input('store');
    $this->user = \User->find($this->user_id);
  }

  public function getHoge(Request $request)
  {
    $values = \Session::get("values");
    if($request->method('get')) {
      if($request->date > date("Y-m-d")) {
        return redirect('hoge')->withInput($request->all());
      }
      $store = \Store::find($this->store_id);
      \Session::put('values', $store);
      // 処理が続く・・
    }elseif($request->method('post')) {
      $validate = \Validator::make($request->all, $this->rule)) {

      if($validate->fails()) {
        // 失敗時の処理
        \Session::put('values', $request->all());
        return redirect('hoge')->withInput($request->all());
      }
      $userData = \UserInfo->where('user_id', $this->user_id);
      foreach($userData as $row) {
        $info = \Purchase->find($row->id);
        \Mail::send('hoge', function() {
            // メール送信
        });
      }
    }
    // 処理が続く・・
  }

}

```
あっという間に数百行なソースコード見たことありませんか？  
そのソースコードテストできますか？

MVCだけを使うのではなく、サービスレイヤなどを意識してデータベースはコントローラーの外へ！  

複数人で開発するようになったらインタフェースや、構造を意識しましょう！  
コンストラクタに4個以上書かれていれば、リファクタリングが必要かもしれません  

###インターフェースを使いましょう！

###軽量化
利用しないミドルウェアや、初期の段階で読み込まれるクラスなど、  
いらなければ外してしまっても良いです。  
やりすぎ注意!  
Contractを利用して再度コンテナに登録し直してあげると良いです。

##データベース編
###Eloquentにこだわらない
使い分けはその時に用途と気分!?  
* シンプルなQueryよりも数倍遅いです。  
* 複雑なSQLに対応するのが厳しい
ifやsum、ストアドプロシージャなどどうします？  

PDOにアクセスすることもでき、またdoctrineなどへ変更することもできます(Eloquentを捨てる)  
そうなった場合でもインターフェースがあれば安心  

###cacheをつかうべし  
通信コストの削減以外にもキャッシュキーをユニークに！  
任意のタイミングで消すこともできます  

```php
public function find($id, array $columns = ['*'], $lifeTime = 120)
{
  if(\Cache::has($this->cacheKey . $id)) {
    return \Cache::get($this->cacheKey . $id);
  }
  $result = \DB::connection($this->slave)->table($this->table)
    ->where($this->primary, $id)->first($columns);
  if($result) {
    \Cache::put($this->cacheKey . $id, $result, $lifeTime);
    return $result;
  }
  return null;
}
```
Authのユーザー情報取得は、デフォルトではcacheを使っていないため、  
実行するたびに発行されています！

##認証編
###Authクラスは自由自在
無理矢理デフォルトの構成に合わせない！  
マネージャークラスを見てみましょう。  
