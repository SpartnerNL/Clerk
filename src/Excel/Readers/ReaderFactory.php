<?php

namespace Maatwebsite\Clerk\Excel\Readers;

use Closure;
use Maatwebsite\Clerk\Drivers\DriverInterface;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Identifiers\FormatIdentifier;
use Maatwebsite\Clerk\Excel\Reader as ReaderInterface;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

/**
 * Class ReaderFactory.
 */
class ReaderFactory
{
    /**
     * @param DriverInterface $driver
     * @param                 $type
     * @param                 $file
     * @param callable        $callback
     *
     * @throws DriverNotFoundException
     * @return ReaderInterface
     */
    public static function create(DriverInterface $driver, $file, Closure $callback = null, $type = null)
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

        throw new DriverNotFoundException("Reader driver [{$driver->getName()}] was not found");
    }

    /**
     * @param DriverInterface $driver
     *
     * @return string
     */
    protected static function getDefaultClass(DriverInterface $driver)
    {
        return $driver->getReaderClass('Excel');
    }

    /**
     * Get a specific reader.
     *
     * @param DriverInterface $driver
     * @param $type
     *
     * @return string
     */
    protected static function getClassByDriverAndType(DriverInterface $driver, $type)
    {
        return $driver->getReaderClassByType('Excel', $type);
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
