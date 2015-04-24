<?php

namespace Maatwebsite\Clerk\Word\Writers;

use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;
use Maatwebsite\Clerk\Word\Document;

class WriterFactory
{
    /**
     * @param          $driver
     * @param          $type
     * @param          $extension
     * @param Document $document
     *
     * @throws DriverNotFoundException
     * @throws ExportFailedException
     * @return Writer
     */
    public static function create($driver, $type, $extension, Document $document)
    {
        $class = self::getClassByDriverAndType($driver, $type);

        if (class_exists($class)) {
            return new $class($type, $extension, $document);
        }

        // Default writer
        $class = self::getClassByDriver($driver);

        if (class_exists($class)) {
            return new $class($type, $extension, $document);
        }

        throw new DriverNotFoundException("Writer driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     *
     * @return string
     */
    protected static function getClassByDriver($driver)
    {
        return 'Maatwebsite\\Clerk\\Word\\Adapters\\' . $driver . '\\Writers\\Writer';
    }

    /**
     * @param $driver
     * @param $type
     *
     * @return string
     */
    private static function getClassByDriverAndType($driver, $type)
    {
        return 'Maatwebsite\\Clerk\\Word\\Adapters\\' . $driver . '\\Writers\\' . ucfirst(strtolower($type)) . 'Writer';
    }
}
