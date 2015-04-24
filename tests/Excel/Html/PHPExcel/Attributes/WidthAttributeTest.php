<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Attributes\WidthAttribute;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;

class WidthAttributeTest extends \PHPUnit_Framework_TestCase {


    public function test_if_width_attribute_gets_translated_to_a_column_width()
    {
        $table = new ReferenceTable();

        $node = new \DOMAttr('width', 20);
        $sheet = $this->mockSheet();

        $attribute = new WidthAttribute($sheet);
        $attribute->parse($node, $table);

        $this->assertEquals('20', $sheet->getDriver()->getColumnDimension($table->getColumn())->getWidth());
    }

    /**
     * @return Sheet
     */
    protected function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}
