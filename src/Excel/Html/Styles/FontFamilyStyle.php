<?php

namespace Maatwebsite\Clerk\Excel\Html\Styles;

use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Cell;

class FontFamilyStyle extends Style
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
        $cell->font()->family($value);
    }
}
