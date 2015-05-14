<?php

namespace Maatwebsite\Clerk\Excel\Workbooks;

use Closure;
use Maatwebsite\Clerk\Drivers\DriverInterface;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

/**
 * Class WorkbookFactory.
 */
class WorkbookFactory
{
    /**
     * @param DriverInterface $driver
     * @param                 $title
     * @param callable        $callback
     *
     * @throws DriverNotFoundException
     * @return Workbook
     */
    public static function create(DriverInterface $driver, $title, Closure $callback = null)
    {
        $class = self::getClassByType($driver);

        if (class_exists($class)) {
            return new $class($title, $callback);
        }

        throw new DriverNotFoundException("Workbook driver [{$driver->getName()}] was not found");
    }

    /**
     * @param DriverInterface $driver
     *
     * @return string
     */
    protected static function getClassByType(DriverInterface $driver)
    {
        return $driver->getWorkbookClass('Excel');
    }
}
