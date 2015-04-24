<?php

namespace Maatwebsite\Clerk\Excel\Writers;

use Maatwebsite\Clerk\Excel\Workbook;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;

/**
 * Class WriterFactory.
 */
class WriterFactory
{
    /**
     * @param          $driver
     * @param          $type
     * @param          $extension
     * @param Workbook $workbook
     *
     * @throws DriverNotFoundException
     * @throws ExportFailedException
     * @return Writer
     */
    public static function create($driver, $type, $extension, Workbook $workbook)
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

        throw new DriverNotFoundException("Writer driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     *
     * @return string
     */
    protected static function getClassByDriver($driver)
    {
        return 'Maatwebsite\\Clerk\\Excel\\Adapters\\' . $driver . '\\Writers\\Writer';
    }

    /**
     * @param $driver
     * @param $type
     *
     * @return string
     */
    private static function getClassByDriverAndType($driver, $type)
    {
        return 'Maatwebsite\\Clerk\\Excel\\Adapters\\' . $driver . '\\Writers\\' . ucfirst(strtolower($type)) . 'Writer';
    }
}
