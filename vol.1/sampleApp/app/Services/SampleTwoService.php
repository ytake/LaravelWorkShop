<?php
namespace App\Services;

/**
 * Class SampleTwoService
 * @package App\Services
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class SampleTwoService implements SampleServiceInterface
{

    /** @var string */
    protected $name = "sample2";

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
