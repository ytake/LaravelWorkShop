<?php
namespace App\Engines;

/**
 * Class Formula
 * @package App\Engines
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Formula implements EngineInterface
{
    
    /**
     * @return mixed
     */
    public function getType()
    {
        return "V型8気筒";
    }
}
