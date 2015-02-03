<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;

class ValignAttribute extends Attribute {

    /**
     * @param DOMAttr        $attribute
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(DOMAttr $attribute, ReferenceTable &$table)
    {
        $this->sheet->cell($table->getColumn() . $table->getRow())
                    ->valign($attribute->value);
    }
}