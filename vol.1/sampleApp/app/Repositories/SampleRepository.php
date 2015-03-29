<?php
namespace App\Repositories;

/**
 * リポジトリ サンプルクラス
 *
 * Class SampleRepository
 * @package App\Repositories
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class SampleRepository
{

    protected $object;

    /**
     *
     */
    public function start()
    {
        $this->object;
    }

    /**
     * @param \StdClass $object
     */
    public function setObject(\StdClass $object)
    {
        $this->object = $object;
    }

}
