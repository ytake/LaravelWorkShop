<?php

class PushCommandTest extends \TestCase
{
    /** @var \App\Commands\PushCommand */
    protected $command;
    public function setUp()
    {
        parent::setUp();
        $this->command = new \App\Commands\PushCommand("testing");
    }

    public function testHandler()
    {
        $filePath = base_path() . '/tests/tests.log';
        \Log::useFiles($filePath);
        $this->command->handle();
        $this->assertFileExists($filePath);
        \File::delete($filePath);
    }
}