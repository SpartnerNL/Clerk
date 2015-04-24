<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html;

use Maatwebsite\Clerk\Excel\Sheet;

class ElementParserFactory
{
    /**
     * @param string $element
     * @param Sheet  $sheet
     *
     * @return mixed
     */
    public static function create($element, Sheet $sheet)
    {
        $class = self::getClass($element);

        if (class_exists($class)) {
            return new $class($sheet);
        }
    }

    /**
     * @param $element
     *
     * @return string
     */
    protected static function getClass($element)
    {
        return __NAMESPACE__ . '\\Elements\\' . ucfirst(strtolower($element)) . 'Element';
    }
}
