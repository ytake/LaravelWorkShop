# Laravel4との違い、移行方法
Laravel4との違いにあげられるものの一つに、名前空間があります。  
名前空間を利用する事がデフォルトとなり、強制されたと思う方も多いと思いますが、  
これらはすべて `composer.json` でオートローダを変更することが可能で、  
これまでのLaravel4と同様にユーザーが利用しやすいように変更することが可能です。
まずは composer についておさらいしましょう。

# composer オートローダおさらい
## classmap
Laravel4のデフォルトで指定されていたオートローダがこれです。
classmapは、これまでphpで利用されていた標準的なrequireを思い浮かべてみると簡単です。  
最近最もよく利用されているpsr-0, psr-4に比べるとレガシーな指定方法と思っておくと良いかもしれません。

classmapは利用する場合に読み込みたいクラスがあるディレクトリを指定します。
たとえば、下記のような指定方法です。

```json
"autoload": {
  "classmap": [
    "app/"
  ]
},
```

この場合、オートロードされるクラスは、`app` ディレクトリ直下のものだけとなります。
`app/AutoloadClass.php` はロードされますが、  
`app/Autoload/AutoloadClass.php` はロードされません。
Laravel4のオートローダーをデフォルトのまま利用していた方の多くは、  
controllers配下にディレクトリを作成すると、その配下のクラスがオートロードされないのは経験してると思います。
これを利用する場合は、ディレクトリなどを追加した場合は都度
```bash
$ composer dump-autoload
```
を実行する必要があります。

## psr-4
これに対して、Laravel5デフォルトのpsr-4はclassmapのような方法ではなく、  
オートロードを利用するクラスとファイルパスのマッピングを定義して利用します。  

```json
"autoload": {
  "psr-4": {
    "App\\": "app/"
  }
},
```
この場合は、`app` ディレクトリを Appという名前空間で表します。  
classmapとの差は、ディレクトリなどを加えた場合でも、名前空間がディレクトリを表してさえいれば
```bash
$ composer dump-autoload
```
は必要ありません。

たとえば、app/Http/Controllersであれば、  
```php
use App\Http\Controller;
```
となります。  

psr-4の指定はいくつ記述しても構いません。  
たとえばフレームワークのappディレクトリ外のものも一緒に指定したい場合は、  
```json
"autoload": {
  "psr-4": {
    "App\\": "app/",
    "Laravel\\Tutorial\\": "sample"
  }
},
```
とすることももちろん可能です。  
多くのIDEなどでそれぞれのオートローダーは補完されますので、  
Laravel5移行時に戸惑うのはこの名前空間利用だと思いますが、  
オートローダの違いをしっかりと覚えておけば非常に簡単だと思います。  
もし理解に自信がなければPHPStormなどの補完機能が強力なIDEを利用することをお勧めします。  
またオートローダは他にも開発時のみに利用する  
```json
"autoload-dev": {
  "classmap": [
    "tests/TestCase.php"
  ]
},
```
があり、本番環境やデプロイ時に除外することができます。  
また、classmap, psr-4は混在していても構いません。  
利用用途に合わせてユーザーが自由に選択することができます。

# Laravel4からの移行方法
psr-4に従って、namespaceを利用する場合は、  
これまで実装してきたクラスにnamespaceをつけ、任意のディレクトリに置くだけです。  

namespaceを利用せずに移行したい場合は、上記のcomposer.jsonのオートローダについてを思い出してください  
下記のようにするとスムーズです  

```json
"autoload": {
  "classmap": [
    "database",
    "app/Console/Commands",
    "app/Http/Controllers",
    "app/Models"
  ],
  "psr-4": {
    "App\\": "app/"
  }
}
```

##注意！
フィルターをそのまま利用することも可能ですが、ミドルウェアへの移行はそこまで大変なものではありません。  

HTML, Formといったヘルパーは5で除外されました。  
そのまま利用したい方は、http://laravelcollective.com/docs/5.0/html をインストールしてください。

その他の移行ポイントを紹介します。  
