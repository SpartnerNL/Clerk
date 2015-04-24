<?php

namespace Maatwebsite\Clerk\Excel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Sheet;

abstract class Attribute
{
    /**
     * @var Sheet
     */
    protected $sheet;

    /**
     * @param Sheet $sheet
     */
    public function __construct(Sheet & $sheet)
    {
        $this->sheet = $sheet;
    }

    /**
     * @param DOMAttr        $attribute
     * @param ReferenceTable $table
     *
     * @return mixed
     */
    abstract public function parse(DOMAttr $attribute, ReferenceTable & $table);
}
