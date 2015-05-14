<?php

namespace Maatwebsite\Clerk\Excel\Writers;

use Maatwebsite\Clerk\Drivers\DriverInterface;
use Maatwebsite\Clerk\Excel\Workbook;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;

/**
 * Class WriterFactory.
 */
class WriterFactory
{
    /**
     * @param DriverInterface $driver
     * @param                 $type
     * @param                 $extension
     * @param Workbook        $workbook
     *
     * @throws DriverNotFoundException
     * @throws ExportFailedException
     * @return Writer
     */
    public static function create(DriverInterface $driver, $type, $extension, Workbook $workbook)
    {
        // Protected export
        if ($workbook->getSheetCount() < 1) {
            throw new ExportFailedException('No sheets are added to your Excel file. Make sure you do so, before attempting to export');
        }

        $class = self::getClassByDriverAndType($driver, $type);

        if (class_exists($class)) {
            return new $class($type, $extension, $workbook);
        }

        // Default writer
        $class = self::getClassByDriver($driver);

        if (class_exists($class)) {
            return new $class($type, $extension, $workbook);
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
        return $driver->getWriterClass('Excel');
    }

    /**
     * @param DriverInterface $driver
     * @param                 $type
     *
     * @return string
     */
    private static function getClassByDriverAndType(DriverInterface $driver, $type)
    {
        return $driver->getWriterClassByType('Excel', $type);
    }
}
