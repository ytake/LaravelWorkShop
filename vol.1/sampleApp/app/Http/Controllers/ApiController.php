<?php
namespace App\Http\Controllers;

use App\Services\SampleServiceInterface;
use App\Services\SingletonServiceInterface;

/**
 * Class ApiController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ApiController extends Controller
{

    /** @var SampleServiceInterface  */
    protected $sample;

    /**
     * @param SampleServiceInterface $sample
     * @param SingletonServiceInterface $singleton
     */
    public function __construct(
        SampleServiceInterface $sample,
        SingletonServiceInterface $singleton
    ) {
        // $singleton->increment();
        // $singleton->getNum();
        $this->sample = $sample;
    }

    /**
     * @param SingletonServiceInterface $singleton
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SingletonServiceInterface $singleton)
    {
        // var_dump($singleton->getNum());
        return response()->json(['name' => $this->sample->getName()]);
    }

}
