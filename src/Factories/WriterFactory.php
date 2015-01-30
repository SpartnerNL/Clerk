<?php namespace Maatwebsite\Clerk\Factories;

use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;
use Maatwebsite\Clerk\Workbook;
use Maatwebsite\Clerk\Writer;

/**
 * Class WriterFactory
 * @package Maatwebsite\Clerk\Factories
 */
class WriterFactory {

    /**
     * @param          $driver
     * @param          $type
     * @param          $extension
     * @param Workbook $workbook
     * @return Writer
     * @throws DriverNotFoundException
     * @throws ExportFailedException
     */
    public static function create($driver, $type, $extension, Workbook $workbook)
    {
        // Protected export
        if ( $workbook->getSheetCount() < 1 )
            throw new ExportFailedException('No sheets are added to your Excel file. Make sure you do so, before attempting to export');

        $class = self::getClassByType($driver);

        if ( class_exists($class) )
            return new $class($type, $extension, $workbook);

        throw new DriverNotFoundException("Writer driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     * @return string
     */
    protected static function getClassByType($driver)
    {
        return 'Maatwebsite\\Clerk\\Adapters\\' . $driver . '\\Writer';
    }
}