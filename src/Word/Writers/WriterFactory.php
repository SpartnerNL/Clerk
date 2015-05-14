<?php

namespace Maatwebsite\Clerk\Word\Writers;

use Maatwebsite\Clerk\Drivers\DriverInterface;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;
use Maatwebsite\Clerk\Word\Document;

class WriterFactory
{
    /**
     * @param DriverInterface $driver
     * @param                 $type
     * @param                 $extension
     * @param Document        $document
     *
     * @throws DriverNotFoundException
     * @throws ExportFailedException
     * @return Writer
     */
    public static function create(DriverInterface $driver, $type, $extension, Document $document)
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

        throw new DriverNotFoundException("Writer driver [{$driver->getName()}] was not found");
    }

    /**
     * @param $driver
     *
     * @return string
     */
    protected static function getClassByDriver(DriverInterface $driver)
    {
        return $driver->getWriterClass('Word');
    }

    /**
     * @param DriverInterface $driver
     * @param                 $type
     *
     * @return string
     */
    private static function getClassByDriverAndType(DriverInterface $driver, $type)
    {
        return $driver->getWriterClassByType('Word', $type);
    }
}
