<?php
namespace App\Services;

/**
 * Class SampleService
 * @package App\Services
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class SampleService implements SampleServiceInterface
{

    /** @var string */
    protected $name;

    /**
     * @param string $name
     */
    public function __construct($name = '')
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
