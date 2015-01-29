<?php namespace Maatwebsite\Clerk\Factories;

use Closure;
use Maatwebsite\Clerk\Workbook;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

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
        return 'Maatwebsite\\Clerk\\Adapters\\' . $driver . '\\Workbook';
    }
}