<?php namespace Maatwebsite\Clerk\Adapters;

abstract class Adapter {

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

        throw new \BadMethodCallException('Method not found');
    }
}