<?php namespace Maatwebsite\Clerk\Tests\Excel\Html\PHPExcel\Attributes;

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Attributes\HeightAttribute;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;

class HeightAttributeTest extends \PHPUnit_Framework_TestCase {


    public function test_if_height_attribute_gets_translated_to_a_row_height()
    {
        $table = new ReferenceTable();
        $node = new \DOMAttr('height', 20);
        $sheet = $this->mockSheet();

        $attribute = new HeightAttribute($sheet);
        $attribute->parse($node, $table);

        $this->assertEquals('20', $sheet->getDriver()->getRowDimension($table->getRow())->getRowHeight());
    }

    /**
     * @return Sheet
     */
    protected function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}