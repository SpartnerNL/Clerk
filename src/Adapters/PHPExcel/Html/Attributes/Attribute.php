<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes;

use DOMNode;
use Maatwebsite\Clerk\Sheet;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

abstract class Attribute {

    /**
     * @var Sheet
     */
    protected $sheet;

    /**
     * @param Sheet $sheet
     */
    public function __construct(Sheet &$sheet)
    {
        $this->sheet = $sheet;
    }

    /**
     * @param DOMNode        $element
     * @param ReferenceTable $table
     * @return mixed
     */
    abstract public function parse(DOMNode $element, ReferenceTable &$table);
}