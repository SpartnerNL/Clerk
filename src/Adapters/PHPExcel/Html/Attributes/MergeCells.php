<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

abstract class MergeCells extends Attribute {

    /**
     * @param DOMAttr     $attribute
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(DOMAttr $attribute, ReferenceTable &$table)
    {
        $range = $this->getStartCell($table) . ':' . $this->getEndCell($attribute, $table);

        $this->sheet->mergeCells($range);
    }

    /**
     * @param $table
     * @return string
     */
    protected function getStartCell(&$table)
    {
        return $table->getColumn() . $table->getRow();
    }

    /**
     * @param $attribute
     * @param $table
     * @return string
     */
    abstract public function getEndCell($attribute, &$table);
}