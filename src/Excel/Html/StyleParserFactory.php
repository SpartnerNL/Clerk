<?php

namespace Maatwebsite\Clerk\Excel\Html;

use Maatwebsite\Clerk\Excel\Html\Styles\Style;
use Maatwebsite\Clerk\Excel\Sheet;

class StyleParserFactory
{
    /**
     * @param string $style
     * @param Sheet  $sheet
     *
     * @return Style|null
     */
    public static function create($style, Sheet $sheet)
    {
        $class = self::getClass($style);

        if (class_exists($class)) {
            return new $class($sheet);
        }
    }

    /**
     * @param string $style
     *
     * @return string
     */
    protected static function getClass($style)
    {
        // Transform to class name
        $style = str_replace(['-', '_'], ' ', $style);
        $style = str_replace(' ', '', ucwords($style));

        return __NAMESPACE__ . '\\Styles\\' . $style . 'Style';
    }
}
