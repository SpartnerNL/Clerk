<?php namespace Maatwebsite\Clerk\Excel\Workbooks;

use Closure;
use Maatwebsite\Clerk\Excel\Workbooks;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

/**
 * Class WorkbookFactory
 * @package Maatwebsite\Clerk\Factories
 */
class WorkbookFactory {

    /**
     * @param          $driver
     * @param          $title
     * @param callable $callback
     * @return Workbook
     * @throws DriverNotFoundException
     */
    public static function create($driver, $title, Closure $callback = null)
    {
        $class = self::getClassByType($driver);

        if ( class_exists($class) )
            return new $class($title, $callback);

        throw new DriverNotFoundException("Workbook driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     * @return string
     */
    protected static function getClassByType($driver)
    {
        return 'Maatwebsite\\Clerk\\Excel\\Adapters\\' . $driver . '\\Workbook';
    }
}