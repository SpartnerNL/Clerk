<?php namespace Maatwebsite\Clerk;

use ArrayAccess;

/**
 * Class Ledger
 * @package Maatwebsite\Clerk
 * Based on Laravel 5 Config Repository
 */
class Ledger implements ArrayAccess {

    /**
     * All of the configuration items.
     *
     * @var array
     */
    protected $items = array(

        'drivers'   => array(
            'csv'       => 'LeagueCsv',
            'excel2003' => 'PHPExcel',
            'excel2007' => 'PHPExcel',
            'word2003'  => 'PHPWord',
            'word2007'  => 'PHPWord',
        ),

        'csv'       => array(
            'delimiter'   => ',',
            'enclosure'   => '"',
            'line_ending' => "\r\n",
            'encoding'    => 'UTF-8'
        ),

        'templates' => array(
            'default' => 'php',
            'engines' => array(
                'blade'  => '.blade',
                'twig'   => '.html',
                'smarty' => '.tpl',
                'php'    => '.php'
            ),
            'path'    => 'templates',
            'cache'   => 'template/.cache',
            'compile' => 'templates/.compiled',
            'config'  => 'templates/config'
        )
    );

    /**
     * Determine if the given configuration value exists.
     *
     * @param  string $key
     * @return bool
     */
    public function hasConfig($key)
    {
        return array_has($this->items, $key);
    }

    /**
     * Get the specified configuration value.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getConfig($key, $default = null)
    {
        return array_get($this->items, $key, $default);
    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string $key
     * @param  mixed        $value
     * @return void
     */
    public function setConfig($key, $value = null)
    {
        if ( is_array($key) )
        {
            foreach ($key as $innerKey => $innerValue)
            {
                array_set($this->items, $innerKey, $innerValue);
            }
        }
        else
        {
            array_set($this->items, $key, $value);
        }
    }

    /**
     * Get all of the configuration items for the application.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Determine if the given configuration option exists.
     *
     * @param  string $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->hasConfig($key);
    }

    /**
     * Get a configuration option.
     *
     * @param  string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->getConfig($key);
    }

    /**
     * Set a configuration option.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->setConfig($key, $value);
    }

    /**
     * Unset a configuration option.
     *
     * @param  string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->setConfig($key, null);
    }

    /**
     * @return Ledger
     */
    public static function getInstance()
    {
        static $instance = null;

        if ( null === $instance )
            $instance = new static();

        return $instance;
    }

    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public static function __callStatic($method, $params)
    {
        return call_user_func_array([static::getInstance(), $method . 'Config'], $params);
    }
}