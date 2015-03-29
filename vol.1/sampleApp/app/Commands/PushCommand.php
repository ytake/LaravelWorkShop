<?php
namespace App\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

/**
 * コマンドクラス
 *
 * Class PushCommand
 * @package App\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PushCommand extends Command implements SelfHandling
{

    /**
     * Illuminate\Contracts\Queue\ShouldBeQueuedインターフェースを実装すると、
     * handlerメソッドに記述した処理がQueueを使って非同期で実行できるようになります。
     * `sync`ドライバはredisやメッセージキューといった外部ミドルウェアを利用しないため、
     * 処理が終わるまで待つことになります
     */

    /** @var string  */
    protected $message;

    /**
     * @param string $message
     */
    public function __construct($message = "hello")
    {
        // リクエスト値はArrayAccessを実装していますので、そのままコンストラクタへマッピングされて渡されます
        $this->message = $message;
    }

    /**
     * \Illuminate\Contracts\Bus\SelfHandlingを実装している場合は、
     * 処理をこのクラス内で記述することができます。
     *
     * コマンドバスクラス生成時に--handlerを指定した場合に、
     * app/Handlers/Commands　ディレクトリにハンドラクラスが生成されますのでそちらに記述します。
     * @return void
     */
    public function handle()
    {
        info($this->message);
    }

}
