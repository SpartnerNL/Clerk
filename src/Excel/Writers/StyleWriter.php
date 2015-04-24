<?php

namespace Maatwebsite\Clerk\Excel\Writers;

use Maatwebsite\Clerk\Excel\Collections\StyleCollection;
use Maatwebsite\Clerk\Excel\Styles\Style;
use ReflectionClass;

class StyleWriter
{
    /**
     * @param StyleCollection $collection
     *
     * @return array
     */
    public function convert(StyleCollection $collection)
    {
        $styles = [];

        foreach ($collection as $style) {
            $method = 'convert' . $this->getStyleName($style);

            if (method_exists($this, $method)) {
                list($name, $value) = $this->{$method}($style);

                $styles[$name] = $value;
            }
        }

        return $styles;
    }

    /**
     * @param Style $style
     *
     * @return string
     */
    protected function getStyleName(Style $style)
    {
        $reflect = new ReflectionClass($style);

        return $reflect->getShortName();
    }
}
