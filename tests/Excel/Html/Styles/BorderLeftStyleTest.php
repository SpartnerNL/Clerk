<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Cells\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Html\Styles\BorderLeftStyle;

class BorderLeftStyleTest extends \PHPUnit_Framework_TestCase
{
    public function test_border_left_style()
    {
        $value = '1px thick 000000';
        $cell = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new BorderLeftStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertContains('000000', $cell->borders()->getLeft()->getColor());
        $this->assertContains('thick', $cell->borders()->getLeft()->getStyle());
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
