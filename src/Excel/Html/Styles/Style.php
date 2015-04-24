<?php

namespace Maatwebsite\Clerk\Excel\Html\Styles;

use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Cell;
use Maatwebsite\Clerk\Excel\Sheet;

abstract class Style
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
     * @param Cell           $cell
     * @param                $value
     * @param ReferenceTable $table
     *
     * @return mixed
     */
    abstract public function parse(Cell $cell, $value, ReferenceTable & $table);
}
