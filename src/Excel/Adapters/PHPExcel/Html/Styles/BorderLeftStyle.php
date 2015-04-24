<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Styles;

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Cell;

class BorderLeftStyle extends BorderStyle
{
    /**
     * @param Cell           $cell
     * @param                $value
     * @param ReferenceTable $table
     *
     * @return mixed
     */
    public function parse(Cell $cell, $value, ReferenceTable & $table)
    {
        list($style, $color) = $this->analyseBorder($value);

        $cell->borders()->left()->setColor($color)->setStyle($style);
    }
}
