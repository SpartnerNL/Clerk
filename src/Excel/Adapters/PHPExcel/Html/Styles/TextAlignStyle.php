<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Styles;

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Cell;

class TextAlignStyle extends Style {

    /**
     * @param                $value
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse($value, ReferenceTable &$table)
    {
        $this->sheet->cell($table->getColumn() . $table->getRow(), function (Cell $cell) use ($value)
        {
            $cell->align($value);
        });
    }
}