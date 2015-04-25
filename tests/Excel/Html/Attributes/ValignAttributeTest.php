<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Html\Attributes\ValignAttribute;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class ValignAttributeTest extends \PHPUnit_Framework_TestCase
{
    public function test_if_valign_attribute_gets_translated_to_valigned_cells()
    {
        $table = new ReferenceTable();

        // Fake as if we are inside a <table>
        $table->setColumn(
            $table->setStartColumn()
        );

        // Fake as if we are inside a <tr>
        $table->nextRow();

        $node  = new \DOMAttr('valign', 'center');
        $sheet = $this->mockSheet();

        $attribute = new ValignAttribute($sheet);
        $attribute->parse($node, $table);

        $this->assertContains('center', $sheet->cell($table->getCoordinate())->valign()->getVertical());
    }

    /**
     * @return Sheet
     */
    protected function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}
