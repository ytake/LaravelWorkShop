<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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