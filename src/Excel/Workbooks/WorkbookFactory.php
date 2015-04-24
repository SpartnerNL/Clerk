<?php

namespace Maatwebsite\Clerk\Excel\Workbooks;

use Closure;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

/**
 * Class WorkbookFactory.
 */
class WorkbookFactory
{
    /**
     * @param          $driver
     * @param          $title
     * @param callable $callback
     *
     * @throws DriverNotFoundException
     * @return Workbook
     */
    public static function create($driver, $title, Closure $callback = null)
    {
        $class = self::getClassByType($driver);

        if (class_exists($class)) {
            return new $class($title, $callback);
        }

        throw new DriverNotFoundException("Workbook driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     *
     * @return string
     */
    protected static function getClassByType($driver)
    {
        return 'Maatwebsite\\Clerk\\Excel\\Adapters\\' . $driver . '\\Workbook';
    }
}
