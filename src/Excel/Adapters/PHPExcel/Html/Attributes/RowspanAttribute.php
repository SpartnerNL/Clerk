<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Attributes;

/**
 * Class RowspanAttribute
 * @package Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes
 */
class RowspanAttribute extends MergeCells {

    /**
     * @param $attribute
     * @param $table
     * @return string
     */
    public function getEndCell($attribute, &$table)
    {
        return $table->getColumn() . ($table->getRow() + ($attribute->value - 1));
    }
}