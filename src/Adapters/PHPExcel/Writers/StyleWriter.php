<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Writers;

use Maatwebsite\Clerk\Cell;
use Maatwebsite\Clerk\Collections\StyleCollection;
use Maatwebsite\Clerk\Style;
use Maatwebsite\Clerk\Styles\Font;
use PHPExcel_Worksheet;
use ReflectionClass;

class StyleWriter {

    /**
     * @param StyleCollection $collection
     * @return array
     */
    public function convert(StyleCollection $collection)
    {
        $styles = [];

        foreach ($collection as $style)
        {
            $method = 'convert' . $this->getStyleName($style);

            if ( method_exists($this, $method) )
            {
                list($name, $value) = $this->{$method}($style);

                $styles[$name] = $value;
            }
        }

        return $styles;
    }

    /**
     * @param Font $font
     * @return array
     */
    public function convertFont(Font $font)
    {
        return [
            'font',
            [
                'name'      => $font->getName(),
                'size'      => $font->getSize(),
                'bold'      => $font->isBold(),
                'italic'    => $font->isItalic(),
                'color'     => ['rgb' => $font->getColor()],
                'underline' => $font->getUnderline()
            ]
        ];
    }

    /**
     * @param Style $style
     * @return string
     */
    protected function getStyleName(Style $style)
    {
        $reflect = new ReflectionClass($style);

        return $reflect->getShortName();
    }
}