<?php

namespace Maatwebsite\Clerk\Excel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Excel\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class AlignAttribute extends Attribute
{
    /**
     * @param DOMAttr        $attribute
     * @param ReferenceTable $table
     *
     * @return mixed
     */
    public function parse(DOMAttr $attribute, ReferenceTable & $table)
    {
        $this->sheet->cell($table->getCoordinate(), function (Cell $cell) use ($attribute) {
            $cell->align($attribute->value);
        });
    }
}
