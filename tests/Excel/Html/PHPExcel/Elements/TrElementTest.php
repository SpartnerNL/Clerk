<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Elements\TrElement;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;

class TrElementTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    public function test_table_gets_parsed()
    {
        $dom = new \DOMElement('tr', '');

        $table = new ReferenceTable();

        // Fake as if we are inside a <table>
        $table->setColumn(
            $table->setStartColumn()
        );

        $sheet = $this->mockSheet();

        $this->assertEquals(0, $table->getRow());

        $element = new TrElement($sheet);
        $element->parse($dom, $table);

        $this->assertEquals(1, $table->getRow());
    }

    /**
     * @return \Maatwebsite\Clerk\Sheet
     */
    public function mockSheet()
    {
        $sheet = \Mockery::mock('Maatwebsite\Clerk\Excel\Sheet');

        return $sheet;
    }
}
