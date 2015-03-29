<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * artisan optimizeコマンドのコンパイルに含ませるファイルを定義することができます。
 * その場合は、staticのcompilesメソッドを利用します。
 * このプロバイダはフレームワークに直接関連付かないため、動作に影響を与えません
 *
 * Class CompilerServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class CompilerServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * @return array
     */
    public static function compiles()
    {
        return [
            app_path("Commands/PushCommand.php"),
        ];
    }

}