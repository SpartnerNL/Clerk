<?php

namespace Maatwebsite\Clerk\Excel\Html\Attributes;

/**
 * Class RowspanAttribute.
 */
class RowspanAttribute extends MergeCells
{
    /**
     * @param $attribute
     * @param $table
     *
     * @return string
     */
    public function getEndCell($attribute, &$table)
    {
        return $table->getColumn() . ($table->getRow() + ($attribute->value - 1));
    }
}
