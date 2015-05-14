<?php

namespace Maatwebsite\Clerk\Excel\Readers;

use Closure;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Identifiers\FormatIdentifier;
use Maatwebsite\Clerk\Excel\Reader as ReaderInterface;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

/**
 * Class ReaderFactory.
 */
class ReaderFactory
{
    /**
     * @param          $driver
     * @param          $type
     * @param          $file
     * @param callable $callback
     *
     * @throws DriverNotFoundException
     * @return ReaderInterface
     */
    public static function create($driver, $file, Closure $callback = null, $type = null)
    {
        $type  = $type ?: self::getTypeByFile($file);
        $class = self::getClassByDriverAndType($driver, $type);

        if (class_exists($class)) {
            return new $class($type, $file, $callback);
        }

        // Get the default writer
        $class = self::getDefaultClass($driver);

        if (class_exists($class)) {
            return new $class($type, $file, $callback);
        }

        throw new DriverNotFoundException("Reader driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     *
     * @return string
     */
    protected static function getDefaultClass($driver)
    {
        return 'Maatwebsite\\Clerk\\Excel\\Adapters\\' . $driver . '\\Readers\Reader';
    }

    /**
     * Get a specific reader.
     *
     * @param $driver
     * @param $type
     *
     * @return string
     */
    protected static function getClassByDriverAndType($driver, $type)
    {
        return 'Maatwebsite\\Clerk\\Excel\\Adapters\\' . $driver . '\\Readers\\' . ucfirst(strtolower($type)) . 'Reader';
    }

    /**
     * @param $file
     *
     * @return string
     */
    protected static function getTypeByFile($file)
    {
        return (new FormatIdentifier())->getFormatByFile($file);
    }
}
