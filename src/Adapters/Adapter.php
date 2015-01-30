<?php namespace Maatwebsite\Clerk\Adapters;

/**
 * Class Adapter
 * @package Maatwebsite\Clerk\Adapters
 */
abstract class Adapter {

    /**
     * @var mixed
     */
    protected $driver;

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        if ( method_exists($this->getDriver(), $method) )
            return call_user_func_array([$this->getDriver(), $method], $params);

        throw new \BadMethodCallException("Method [{$method}] not found on Reader");
    }
}