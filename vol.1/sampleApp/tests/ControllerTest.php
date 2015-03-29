<?php

class ControllerTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHomeController()
    {
        $this->assertEquals(200, $this->call('GET', '/')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', '/form')->getStatusCode());
        $this->assertEquals(302, $this->call('POST', '/confirm',
            ["_token" => \Session::token()])->getStatusCode()
        );
        $this->assertEquals(200,
            $this->call('POST', '/confirm', ["_token" => \Session::token(), 'name' => 'testing'])->getStatusCode()
        );
        $this->assertEquals(302, $this->call('POST', '/apply',
            ["_token" => \Session::token()])->getStatusCode()
        );
        $this->assertEquals(200,
            $this->call('POST', '/apply', ["_token" => \Session::token(), 'name' => 'testing'])->getStatusCode()
        );
        $this->assertEquals(302,
            $this->call('POST', '/apply', ["_token" => \Session::token(), 'name' => 'testing', '_return' => true])->getStatusCode()
        );
    }

    public function testApiController()
    {
        $response = $this->call('GET', '/v1/api');
        $content = json_decode($response->getContent(), 1);
        $this->assertArrayHasKey('name', $content);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testApiControllerBind()
    {
        \App::bind('App\Services\SampleServiceInterface', function ($app) {
            return \App::make('App\Services\SampleService', ['name' => 'testing']);
        });
        $response = $this->call('GET', '/v1/api');
        $content = json_decode($response->getContent(), 1);
        $this->assertArrayHasKey('name', $content);
        $this->assertSame('testing', $content['name']);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testFormulaController()
    {
        $response = $this->call('GET', '/f1');
        $content = json_decode($response->getContent(), 1);
        $this->assertSame('V型8気筒', $content['engine']);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testRallyController()
    {
        $response = $this->call('GET', '/wrc');
        $content = json_decode($response->getContent(), 1);
        $this->assertSame('V型6気筒', $content['engine']);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testBusController()
    {
        \App::bind("Illuminate\Contracts\Bus\Dispatcher", "MockCommandBus");
        $response = $this->call('GET', '/bus');
        $this->assertEquals(200, $response->getStatusCode());
    }
}

class MockCommandBus implements \Illuminate\Contracts\Bus\Dispatcher
{
    /**
     * Marshal a command and dispatch it to its appropriate handler.
     *
     * @param mixed $command
     * @param array $array
     * @return mixed
     */
    public function dispatchFromArray($command, array $array)
    {
// TODO: Implement dispatchFromArray() method.
    }
    /**
     * Marshal a command and dispatch it to its appropriate handler.
     *
     * @param mixed $command
     * @param \ArrayAccess $source
     * @param array $extras
     * @return mixed
     */
    public function dispatchFrom($command, ArrayAccess $source, array $extras = [])
    {
// TODO: Implement dispatchFrom() method.
    }
    /**
     * Dispatch a command to its appropriate handler.
     *
     * @param mixed $command
     * @param \Closure|null $afterResolving
     * @return mixed
     */
    public function dispatch($command, Closure $afterResolving = null)
    {
// TODO: Implement dispatch() method.
    }
    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param mixed $command
     * @param \Closure|null $afterResolving
     * @return mixed
     */
    public function dispatchNow($command, Closure $afterResolving = null)
    {
// TODO: Implement dispatchNow() method.
    }
    /**
     * Set the pipes commands should be piped through before dispatching.
     *
     * @param array $pipes
     * @return $this
     */
    public function pipeThrough(array $pipes)
    {
// TODO: Implement pipeThrough() method.
    }
}