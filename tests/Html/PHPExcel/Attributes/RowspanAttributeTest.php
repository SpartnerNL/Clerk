<?php namespace Maatwebsite\Clerk\Tests\Html\PHPExcel\Attributes;

use Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes\RowspanAttribute;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Adapters\PHPExcel\Workbook;

class RowspanAttributeTest extends \PHPUnit_Framework_TestCase {


    public function test_if_rowspan_attribute_gets_translated_to_a_merged_rows()
    {
        $table = new ReferenceTable();

        // Fake as if we are inside a <table>
        $table->setColumn(
            $table->setStartColumn()
        );

        // Fake as if we are inside a <tr>
        $table->nextRow();

        $node = new \DOMAttr('rowspan', 3);
        $sheet = $this->mockSheet();

        $attribute = new RowspanAttribute($sheet);
        $attribute->parse($node, $table);

        // 3 rows in the first column
        $this->assertContains('A1:A3', $sheet->getMergeCells());
    }

    /**
     * @return Sheet
     */
    protected function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}