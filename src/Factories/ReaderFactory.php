<?php namespace Maatwebsite\Clerk\Factories;

use Closure;
use Maatwebsite\Clerk\Adapters\PHPExcel\Identifiers\FormatIdentifier;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Reader;

/**
 * Class ReaderFactory
 * @package Maatwebsite\Clerk\Factories
 */
class ReaderFactory {

    /**
     * @param          $driver
     * @param          $type
     * @param          $file
     * @param callable $callback
     * @return Reader
     * @throws DriverNotFoundException
     */
    public static function create($driver, $file, Closure $callback = null, $type = null)
    {
        $class = self::getClassByDriver($driver);
        $type = $type ?: self::getTypeByFile($file);

        if ( class_exists($class) )
            return new $class($type, $file, $callback);

        throw new DriverNotFoundException("Reader driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     * @return string
     */
    protected static function getClassByDriver($driver)
    {
        return 'Maatwebsite\\Clerk\\Adapters\\' . $driver . '\\Reader';
    }

    /**
     * @param $file
     * @return string
     */
    protected static function getTypeByFile($file)
    {
        return (new FormatIdentifier())->getFormatByFile($file);
    }
}