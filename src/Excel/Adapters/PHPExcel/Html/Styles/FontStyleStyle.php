<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Styles;

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Cell;

class FontStyleStyle extends Style {

    /**
     * @param Cell           $cell
     * @param                $value
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(Cell $cell, $value, ReferenceTable &$table)
    {
        if ( $value == 'italic' )
        {
            $cell->font()->italic();
        }
        elseif ( $value == 'normal' )
        {
            $cell->font()->italic(false);
        }
    }
}