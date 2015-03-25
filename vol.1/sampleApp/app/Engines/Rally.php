<?php
namespace App\Engines;

/**
 * Class Rally
 * @package App\Engines
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Rally implements EngineInterface
{

    /**
     * @return mixed
     */
    public function getType()
    {
        return "V型6気筒";
    }
}
