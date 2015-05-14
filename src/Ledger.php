<?php

namespace Maatwebsite\Clerk;

use ArrayAccess;
use Closure;
use Maatwebsite\Clerk\Drivers\DriverInterface;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

/**
 * Class Ledger.
 */
class Ledger implements ArrayAccess
{

    /**
     * All of the configuration items.
     * @var array
     */
    protected $items = [

        'drivers'   => [
            'writer' => [
                'pdf'       => 'Snappy',
                'csv'       => 'LeagueCsv',
                'excel2003' => 'PHPExcel',
                'excel2007' => 'PHPExcel',
                'word2003'  => 'PHPWord',
                'word2007'  => 'PHPWord',
            ],
            'reader' => [
                'pdf'       => 'Snappy',
                'csv'       => 'LeagueCsv',
                'excel2003' => 'PHPExcel',
                'excel2007' => 'PHPExcel',
                'word2003'  => 'PHPWord',
                'word2007'  => 'PHPWord',
            ]
        ],
        'csv'       => [
            'delimiter'   => ',',
            'enclosure'   => '"',
            'line_ending' => "\r\n",
            'encoding'    => 'UTF-8',
        ],
        'pdf'       => [
            'snappy' => [
                'binary'  => '/usr/local/bin/wkhtmltopdf',
                'options' => [],
                'timeout' => false,
            ]
        ],
        'templates' => [
            'default' => 'php',
            'engines' => [
                'blade'  => '.blade',
                'twig'   => '.html',
                'smarty' => '.tpl',
                'php'    => '.php',
            ],
            'path'    => 'templates',
            'cache'   => 'template/.cache',
            'compile' => 'templates/.compiled',
            'config'  => 'templates/config',
        ],
    ];

    /**
     * @var array
     */
    protected $drivers = [];

    /**
     * @param          $key
     * @param callable $callback
     *
     * @return mixed
     * @throws \ErrorException
     */
    public function registerConfig($key, Closure $callback)
    {
        $driver = call_user_func($callback);

        if ($driver instanceof DriverInterface) {
            $this->drivers[$key] = $driver;

            return $driver;
        }

        throw new \ErrorException('You should return a class that implements DriverInterface');
    }

    /**
     * Get the specified configuration value.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     * @throws DriverNotFoundException
     */
    public function resolveConfig($key, $default = null)
    {
        $driverName = str_replace('drivers.', '', $key);

        if (isset($this->drivers[$driverName])) {
            return $this->drivers[$driverName];
        }

        $class = __NAMESPACE__ . '\\Drivers\\' . $this->getConfig($key, $default);

        if (class_exists($class)) {
            return $this->registerConfig($driverName, function () use ($class, $key) {
                return new $class($key);
            });
        }

        throw new DriverNotFoundException("Driver {$this->getConfig($key, $default)} not found");
    }

    /**
     * Determine if the given configuration value exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasConfig($key)
    {
        return array_has($this->items, $key);
    }

    /**
     * Get the specified configuration value.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getConfig($key, $default = null)
    {
        return array_get($this->items, $key, $default);
    }

    /**
     * Set a given configuration value.
     *
     * @param array|string $key
     * @param mixed        $value
     */
    public function setConfig($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $innerKey => $innerValue) {
                array_set($this->items, $innerKey, $innerValue);
            }
        } else {
            array_set($this->items, $key, $value);
        }
    }

    /**
     * Get all of the configuration items for the application.
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Determine if the given configuration option exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->hasConfig($key);
    }

    /**
     * Get a configuration option.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->getConfig($key);
    }

    /**
     * Set a configuration option.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function offsetSet($key, $value)
    {
        $this->setConfig($key, $value);
    }

    /**
     * Unset a configuration option.
     *
     * @param string $key
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

        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param $method
     * @param $params
     *
     * @return mixed
     */
    public static function __callStatic($method, $params)
    {
        return call_user_func_array([static::getInstance(), $method . 'Config'], $params);
    }
}
