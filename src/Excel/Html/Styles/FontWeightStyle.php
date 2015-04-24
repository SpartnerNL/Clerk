<?php

namespace Maatwebsite\Clerk\Excel\Html\Styles;

use Maatwebsite\Clerk\Excel\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class FontWeightStyle extends Style
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
        if ($value == 'bold' || $value >= 500) {
            $cell->font()->bold();
        } elseif ($value == 'normal' || $value < 500) {
            $cell->font()->bold(false);
        }
    }
}
