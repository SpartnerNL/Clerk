<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Styles;

use Maatwebsite\Clerk\Excel\Cell;
use Maatwebsite\Clerk\Excel\Styles\Border;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;

class BorderStyle extends Style {

    /**
     * @param Cell           $cell
     * @param                $value
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(Cell $cell, $value, ReferenceTable &$table)
    {
        list($style, $color) = $this->analyseBorder($value);

        $cell->border()->setColor($color)->setStyle($style);
    }

    /**
     * @param $value
     * @return array
     */
    protected function analyseBorder($value)
    {
        $borders = explode(' ', $value);
        $style = $borders[1];
        $color = end($borders);

        // Set border style to thin
        if ( $style == 'solid' )
            $style = Border::BORDER_THIN;

        return [
            $style,
            $color
        ];
    }
}