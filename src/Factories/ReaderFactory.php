<?php namespace Maatwebsite\Clerk\Factories;

use Closure;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

class ReaderFactory {

    /**
     * @param          $driver
     * @param          $type
     * @param          $file
     * @param callable $callback
     * @return
     * @throws DriverNotFoundException
     */
    public static function create($driver, $type, $file, Closure $callback = null)
    {
        $class = self::getClassByType($driver);

        if ( class_exists($class) )
            return new $class($type, $file, $callback);

        throw new DriverNotFoundException("Reader driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     * @return string
     */
    protected static function getClassByType($driver)
    {
        return 'Maatwebsite\\Clerk\\Adapters\\' . $driver . '\\Reader';
    }
}