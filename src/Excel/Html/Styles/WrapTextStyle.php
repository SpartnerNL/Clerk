<?php

namespace Maatwebsite\Clerk\Excel\Html\Styles;

use Maatwebsite\Clerk\Excel\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

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
