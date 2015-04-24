<?php

namespace Maatwebsite\Clerk\Excel\Html;

use Maatwebsite\Clerk\Excel\Html\Attributes\Attribute;
use Maatwebsite\Clerk\Excel\Sheet;

class AttributeParserFactory
{
    /**
     * @param string $attribute
     * @param Sheet  $sheet
     *
     * @return Attribute|null
     */
    public static function create($attribute, Sheet $sheet)
    {
        $class = self::getClass($attribute);

        if (class_exists($class)) {
            return new $class($sheet);
        }
    }

    /**
     * @param string $attribute
     *
     * @return string
     */
    protected static function getClass($attribute)
    {
        return __NAMESPACE__ . '\\Attributes\\' . ucfirst(strtolower($attribute)) . 'Attribute';
    }
}
