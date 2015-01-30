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
        $type = $type ?: self::getTypeByFile($file);
        $class = self::getClassByDriverAndType($driver, $type);

        if ( class_exists($class) )
            return new $class($type, $file, $callback);

        // Get the default writer
        $class = self::getDefaultClass($driver);

        if ( class_exists($class) )
            return new $class($type, $file, $callback);

        throw new DriverNotFoundException("Reader driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     * @return string
     */
    protected static function getDefaultClass($driver)
    {
        return 'Maatwebsite\\Clerk\\Adapters\\' . $driver . '\\Readers\Reader';
    }

    /**
     * Get a specific reader
     * @param $driver
     * @param $type
     * @return string
     */
    protected static function getClassByDriverAndType($driver, $type)
    {
        return 'Maatwebsite\\Clerk\\Adapters\\' . $driver . '\\Readers\\' . ucfirst(strtolower($type)) . 'Reader';
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