<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Attributes\ColspanAttribute;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;

class ColspanAttributeTest extends \PHPUnit_Framework_TestCase {


    public function test_if_colspan_attribute_gets_translated_to_merged_cells()
    {
        $table = new ReferenceTable();

        // Fake as if we are inside a <table>
        $table->setColumn(
            $table->setStartColumn()
        );

        // Fake as if we are inside a <tr>
        $table->nextRow();

        $node = new \DOMAttr('colspan', 3);
        $sheet = $this->mockSheet();

        $attribute = new ColspanAttribute($sheet);
        $attribute->parse($node, $table);

        // 3 columns on the first row
        $this->assertContains('A1:C1', $sheet->getMergeCells());
    }

    /**
     * @return Sheet
     */
    protected function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}
