<?php

class HomeRequestTest extends TestCase
{
    /** @var \App\Http\Requests\HomeRequest  */
    protected $request;

    public function setUp()
    {
        $this->request = new \App\Http\Requests\HomeRequest();
    }

    public function testAuth()
    {
        $this->assertTrue($this->request->authorize());
    }

    public function testValidate()
    {
        $this->assertArrayHasKey('name', $this->request->rules());
        $this->assertInternalType('array', $this->request->messages());
    }
}
