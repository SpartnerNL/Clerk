<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Styles;

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Cell;

class WrapTextStyle extends Style
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
        if ($value == 'true') {
            $state = true;
        }

        if (!$value || $value == 'false') {
            $state = false;
        }

        $cell->align()->wrapText($state);
    }
}
