<?php

namespace Maatwebsite\Clerk\Excel\Html\Attributes;

/**
 * Class ColspanAttribute.
 */
class ColspanAttribute extends MergeCells
{
    /**
     * @param $attribute
     * @param $table
     *
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
