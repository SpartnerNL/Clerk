<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers;

use ReflectionClass;
use Maatwebsite\Clerk\Excel\Styles\Font;
use Maatwebsite\Clerk\Excel\Styles\Style;
use Maatwebsite\Clerk\Excel\Collections\StyleCollection;

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