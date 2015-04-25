<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Cells\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Html\Styles\FontFamilyStyle;

class FontFamilyStyleTest extends \PHPUnit_Framework_TestCase
{
    public function test_font_family()
    {
        $value = 'verdana';
        $cell  = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new FontFamilyStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertContains('verdana', $cell->font()->getName());
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
