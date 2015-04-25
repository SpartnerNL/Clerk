<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Html\Attributes\AlignAttribute;
use Maatwebsite\Clerk\Excel\Html\Attributes\StyleAttribute;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class StyleAttributeTest extends \PHPUnit_Framework_TestCase
{
    public function test_if_style_attribute()
    {
        $table = new ReferenceTable();

        // Fake as if we are inside a <table>
        $table->setColumn(
            $table->setStartColumn()
        );

        // Fake as if we are inside a <tr>
        $table->nextRow();

        $node  = new \DOMAttr('style', 'text-align:center;');
        $sheet = $this->mockSheet();

        $attribute = new StyleAttribute($sheet);
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
