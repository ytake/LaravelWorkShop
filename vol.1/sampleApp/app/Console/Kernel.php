<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\Inspire',
    ];

    /**
     * 新機能のスケジュール機能です。
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // crontabへ記述するのと同様に記述します。
        $schedule->command('inspire')
            ->hourly();
        // 実行内容をログとして保存したり、メールを送信したりすることができます
        $schedule->command('inspire')
            ->sendOutputTo(storage_path('app/output.log'))
            ->cron('* * * * * *');
    }

}
