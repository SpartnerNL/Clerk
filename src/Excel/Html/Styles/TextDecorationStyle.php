<?php

namespace Maatwebsite\Clerk\Excel\Html\Styles;

use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Cell;

class TextDecorationStyle extends Style
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
        switch ($value) {
            case 'underline':
                $cell->font()->underline();

            case 'line-through':
                $cell->font()->strikethrough();
        }
    }
}
