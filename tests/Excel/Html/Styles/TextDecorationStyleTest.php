<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Cells\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Html\Styles\TextDecorationStyle;

class TextDecorationStyleTest extends \PHPUnit_Framework_TestCase
{
    public function test_text_underline()
    {
        $value = 'underline';
        $cell  = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new TextDecorationStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertEquals('single', $cell->font()->getUnderline());
    }

    public function test_text_strikethrough()
    {
        $value = 'line-through';
        $cell  = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new TextDecorationStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertTrue($cell->font()->getStrikethrough());
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
