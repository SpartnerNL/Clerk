<?php namespace Maatwebsite\Clerk\Tests\Html\PHPExcel\Elements;

use Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements\TableElement;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

class TableElementTest extends \PHPUnit_Framework_TestCase {


    public function tearDown()
    {
        \Mockery::close();
    }


    public function test_table_gets_parsed()
    {
        $dom = new \DOMElement('table', '');
        $table = new ReferenceTable();
        $sheet = $this->mockSheet();

        $this->assertEquals(0, $table->getRow());

        $element = new TableElement($sheet);
        $element->parse($dom, $table);

        $this->assertEquals(1, $table->getRow());
    }


    /**
     * @return \Maatwebsite\Clerk\Sheet
     */
    public function mockSheet()
    {
        $sheet = \Mockery::mock('Maatwebsite\Clerk\Sheet');

        return $sheet;
    }
}