<?php

namespace Maatwebsite\Clerk\Word\Documents;

use Closure;
use Maatwebsite\Clerk\Drivers\DriverInterface;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

class DocumentFactory
{
    /**
     * @param DriverInterface $driver
     * @param                 $title
     * @param callable        $callback
     *
     * @throws DriverNotFoundException
     * @return File
     */
    public static function create(DriverInterface $driver, $title, Closure $callback = null)
    {
        $class = self::getClassByType($driver);

        if (class_exists($class)) {
            return new $class($title, $callback);
        }

        throw new DriverNotFoundException("Word driver [{$driver->getName()}] was not found");
    }

    /**
     * @param DriverInterface $driver
     *
     * @return string
     */
    protected static function getClassByType(DriverInterface $driver)
    {
        return $driver->getDocumentClass('Word');
    }
}
