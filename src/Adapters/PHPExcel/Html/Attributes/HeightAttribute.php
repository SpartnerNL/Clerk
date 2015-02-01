<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes;

use DOMNode;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

class HeightAttribute extends Attribute {

    /**
     * @param DOMNode        $element
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(DOMNode $element, ReferenceTable &$table)
    {
        $this->sheet->setRowHeight(
            $table->getRow(),
            $element->value
        );
    }
}