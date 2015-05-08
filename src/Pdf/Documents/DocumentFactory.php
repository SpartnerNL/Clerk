<?php

namespace Maatwebsite\Clerk\Pdf\Documents;

use Closure;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

class DocumentFactory
{
    /**
     * @param          $driver
     * @param          $title
     * @param callable $callback
     *
     * @throws DriverNotFoundException
     * @return File
     */
    public static function create($driver, $title, Closure $callback = null)
    {
        $class = self::getClassByType($driver);

        if (class_exists($class)) {
            return new $class($title, $callback);
        }

        throw new DriverNotFoundException("Pdf driver [{$driver}] was not found");
    }

    /**
     * @param $driver
     *
     * @return string
     */
    protected static function getClassByType($driver)
    {
        return 'Maatwebsite\\Clerk\\Pdf\\Adapters\\' . $driver . '\\Document';
    }
}
