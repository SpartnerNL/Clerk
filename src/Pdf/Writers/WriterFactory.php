<?php

namespace Maatwebsite\Clerk\Pdf\Writers;

use Maatwebsite\Clerk\Drivers\DriverInterface;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;
use Maatwebsite\Clerk\Pdf\Document;

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
        // Default writer
        $class = self::getClassByDriver($driver);

        if (class_exists($class)) {
            return new $class($type, $extension, $document);
        }

        throw new DriverNotFoundException("Writer driver [{$driver->getName()}] was not found");
    }

    /**
     * @param DriverInterface $driver
     *
     * @return string
     */
    protected static function getClassByDriver(DriverInterface $driver)
    {
        return $driver->getWriterClass('Pdf');
    }
}
