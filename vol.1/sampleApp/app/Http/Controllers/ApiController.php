<?php
namespace App\Http\Controllers;

use App\Services\SampleServiceInterface;
use App\Services\SingletonServiceInterface;

/**
 * jsonを返却する簡単なコントローラで、
 * コンストラクタインジェクションを利用したサンプルです。
 * コンテナへの登録方法は下記を参照してください。
 * @see \App\Providers\AppServiceProvider
 *
 * Class ApiController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ApiController extends Controller
{

    /** @var SampleServiceInterface  */
    protected $sample;

    /** @var SingletonServiceInterface  */
    protected $singleton;

    /**
     * @param SampleServiceInterface $sample
     * @param SingletonServiceInterface $singleton
     */
    public function __construct(
        SampleServiceInterface $sample,
        SingletonServiceInterface $singleton
    ) {
        // シングルトンの動作を確認する場合はコメントアウトを外してください
        // $singleton->increment();
        // $singleton->getNum();
        $this->sample = $sample;
    }

    /**
     * uri : "/v1/api" [GET]
     * @param SingletonServiceInterface $singleton
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SingletonServiceInterface $singleton)
    {
        // var_dump($singleton->getNum());
        return response()->json(['name' => $this->sample->getName()]);
    }

}
