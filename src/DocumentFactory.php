<?php namespace Maatwebsite\Clerk;

use Closure;
use Maatwebsite\Clerk\Files\File;
use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;

class DocumentFactory {

    /**
     * @param          $type
     * @param          $title
     * @param callable $callback
     * @return File
     * @throws DriverNotFoundException
     */
    public static function create($type, $title, Closure $callback = null)
    {
        $class = self::getClassByType($type);

        if ( class_exists($class) )
            return new $class($title, $callback);

        throw new DriverNotFoundException("Document type [{$type}] was not found");
    }

    /**
     * @param $type
     * @return string
     */
    protected static function getClassByType($type)
    {
        return 'Maatwebsite\\Clerk\\Files\\' . $type;
    }
}