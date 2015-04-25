<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Cells\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Html\Styles\BackgroundStyle;

class BackgroundStyleTest extends \PHPUnit_Framework_TestCase
{
    public function test_background_color_style()
    {
        $value = '000000';
        $cell  = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new BackgroundStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertContains('000000', $cell->fill()->getColor());
    }

    public function test_background_color_style_with_hash()
    {
        $value = '#000000';
        $cell  = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new BackgroundStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertContains('000000', $cell->fill()->getColor());
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
