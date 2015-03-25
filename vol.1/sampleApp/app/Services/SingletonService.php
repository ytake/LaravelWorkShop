<?php
namespace App\Services;

/**
 * Class SampleService
 * @package App\Services
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class SingletonService implements SingletonServiceInterface
{

    /** @var int  */
    protected $num = 1;

    /**
     * increment
     * return @void
     */
    public function increment()
    {
        $this->num += 1;
    }

    /**
     * @return int
     */
    public function getNum()
    {
        return $this->num;
    }

}
