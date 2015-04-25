<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Html\Attributes\AlignAttribute;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class AlignAttributeTest extends \PHPUnit_Framework_TestCase
{
    public function test_if_align_attribute_gets_translated_to_aligned_cells()
    {
        $table = new ReferenceTable();

        // Fake as if we are inside a <table>
        $table->setColumn(
            $table->setStartColumn()
        );

        // Fake as if we are inside a <tr>
        $table->nextRow();

        $node  = new \DOMAttr('align', 'center');
        $sheet = $this->mockSheet();

        $attribute = new AlignAttribute($sheet);
        $attribute->parse($node, $table);

        $this->assertContains('center', $sheet->cell($table->getCoordinate())->align()->getHorizontal());
    }

    /**
     * @return Sheet
     */
    protected function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}
