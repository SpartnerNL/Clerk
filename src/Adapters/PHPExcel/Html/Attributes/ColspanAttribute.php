<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes;

use DOMNode;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

/**
 * Class ColspanAttribute
 * @package Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes
 */
class ColspanAttribute extends Attribute {

    /**
     * @param DOMNode        $element
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(DOMNode $element, ReferenceTable &$table)
    {
        // Set start cell
        $startCell = $table->getColumn() . $table->getRow();

        // Find end column letter
        $table->nextColumn($element->value - 1);

        // Set end cell
        $endCell = $table->getColumn() . $table->getRow();

        // Set range
        $range = $startCell . ':' . $endCell;

        // Merge the cells
        $this->sheet->mergeCells($range);
    }
}