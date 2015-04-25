<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Cells\Cell;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Html\Styles\VerticalAlignStyle;

class VerticalAlignStyleTest extends \PHPUnit_Framework_TestCase
{
    public function test_vertical_align_center()
    {
        $value = 'center';
        $cell  = $this->mockCell();
        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        $attribute = new VerticalAlignStyle($sheet);
        $attribute->parse($cell, $value, $table);

        $this->assertEquals('center', $cell->valign()->getVertical());
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
