<?php

class EngineTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testEngineType()
    {
        $rally = new \App\Engines\Rally();
        $this->assertSame("V型6気筒", $rally->getType());
        $formula = new \App\Engines\Formula();
        $this->assertSame("V型8気筒", $formula->getType());
    }
}