<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes;

/**
 * Class ColspanAttribute
 * @package Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes
 */
class ColspanAttribute extends MergeCells {

    /**
     * @param $attribute
     * @param $table
     * @return string
     */
    public function getEndCell($attribute, &$table)
    {
        // Find end column letter
        $table->nextColumn($attribute->value - 1);

        // Set end cell
        return $table->getColumn() . $table->getRow();
    }
}