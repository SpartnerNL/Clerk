<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers;

use Maatwebsite\Clerk\Excel\Styles\Alignment;
use Maatwebsite\Clerk\Excel\Styles\Border;
use Maatwebsite\Clerk\Excel\Styles\Borders;
use Maatwebsite\Clerk\Excel\Styles\Fill;
use Maatwebsite\Clerk\Excel\Styles\Font;
use Maatwebsite\Clerk\Excel\Writers\StyleWriter as AbstractStyleWriter;

class StyleWriter extends AbstractStyleWriter
{
    /**
     * @param Font $font
     *
     * @return array
     */
    protected function convertFont(Font $font)
    {
        return [
            'font',
            [
                'name'      => $font->getName(),
                'size'      => $font->getSize(),
                'bold'      => $font->isBold(),
                'italic'    => $font->isItalic(),
                'color'     => ['rgb' => $font->getColor()],
                'underline' => $font->getUnderline(),
                'strike'    => $font->getStrikethrough(),
            ],
        ];
    }

    /**
     * @param Fill $fill
     *
     * @return array
     */
    protected function convertFill(Fill $fill)
    {
        return [
            'fill',
            [
                'type'  => $fill->getType(),
                'color' => ['rgb' => $fill->getColor()],
            ],
        ];
    }

    /**
     * @param Alignment $alignment
     *
     * @return array
     */
    protected function convertAlignment(Alignment $alignment)
    {
        return [
            'alignment',
            [
                'horizontal' => $alignment->getHorizontal(),
                'vertical'   => $alignment->getVertical(),
                'wrap'       => $alignment->getWrapText(),
                'indent'     => $alignment->getTextIndent(),
            ],
        ];
    }

    /**
     * @param Border $border
     *
     * @return array
     */
    protected function convertBorder(Border $border)
    {
        return [
            'borders',
            [
                'allborders' => [
                    'style' => $border->getStyle(),
                    'color' => ['rgb' => $border->getColor()],
                ],
            ],
        ];
    }

    /**
     * @param Borders $border
     *
     * @return array
     */
    protected function convertBorders(Borders $border)
    {
        $borders = [];

        if ($border->getTop()) {
            $borders['top'] = [
                'color' => ['rgb' => $border->getTop()->getColor()],
                'style' => $border->getTop()->getStyle(),
            ];
        }

        if ($border->getBottom()) {
            $borders['bottom'] = [
                'color' => ['rgb' => $border->getBottom()->getColor()],
                'style' => $border->getBottom()->getStyle(),
            ];
        }

        if ($border->getLeft()) {
            $borders['left'] = [
                'color' => ['rgb' => $border->getLeft()->getColor()],
                'style' => $border->getLeft()->getStyle(),
            ];
        }

        if ($border->getRight()) {
            $borders['right'] = [
                'color' => ['rgb' => $border->getRight()->getColor()],
                'style' => $border->getRight()->getStyle(),
            ];
        }

        return [
            'borders',
            $borders,
        ];
    }
}
