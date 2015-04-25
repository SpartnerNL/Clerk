<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Cells\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Html\Styles\ColorStyle;

class ColorStyleTest extends \PHPUnit_Framework_TestCase
{
    public function test_text_color()
    {
        $value = '333333';
        $cell  = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new ColorStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertContains('333333', $cell->font()->getColor());
    }

    /**
     * @return Cell
     */
    protected function mockCell()
    {
        return new Cell('name');
    }

    /**
     * @return Sheet
     */
    protected function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}
