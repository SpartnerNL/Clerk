<?php namespace Maatwebsite\Clerk\Factories;

use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Workbook;

class WriterFactory {

    /**
     * @param          $driver
     * @param          $type
     * @param          $extension
     * @param Workbook $workbook
     * @return
     * @throws DriverNotFoundException
     */
    public static function create($driver, $type, $extension, Workbook $workbook)
    {
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