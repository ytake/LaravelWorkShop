<?php
namespace App\Services;

/**
 * Interface SingletonServiceInterface
 * @package App\Services
 */
interface SingletonServiceInterface
{

    /**
     * increment
     * return @void
     */
    public function increment();

    /**
     * @return int
     */
    public function getNum();

}
