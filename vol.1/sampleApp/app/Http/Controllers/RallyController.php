<?php
namespace App\Http\Controllers;

use App\Engines\EngineInterface;

/**
 * Class RallyController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class RallyController extends Controller
{

    /** @var EngineInterface  */
    protected $engine;

    /**
     * @param EngineInterface $engine
     */
    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response()->json(['engine' => $this->engine->getType()]);
    }
}
