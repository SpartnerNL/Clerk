<?php

namespace Maatwebsite\Clerk\Excel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Excel\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class ValignAttribute extends Attribute
{
    /**
     * @param DOMAttr        $attribute
     * @param ReferenceTable $table
     *
     * @return mixed
     */
    public function parse(DOMAttr $attribute, ReferenceTable & $table)
    {
        $this->sheet->cell($table->getColumn() . $table->getRow(), function (Cell $cell) use ($attribute) {
            $cell->valign($attribute->value);
        });
    }
}
