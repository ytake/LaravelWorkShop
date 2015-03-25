<?php
namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

/**
 * Class PushCommand
 * @package App\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PushCommand extends Command implements SelfHandling, ShouldBeQueued
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
