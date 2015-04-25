<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Html\Elements\AElement;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class AElementTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    public function test_a_element_gets_parsed()
    {
        $doc = new DOMDocument();
        $dom = $doc->createElement('a');
        $dom->setAttribute('href', 'http://google.com');

        $sheet = $this->mockSheet();
        $table = new ReferenceTable();

        // Fake as if we are inside a <table>
        $table->setColumn(
            $table->setStartColumn()
        );

        // Fake as if we are inside a <tr>
        $table->nextRow();

        $element = new AElement($sheet);
        $element->parse($dom, $table);

        $this->assertEquals('http://google.com', $sheet->getCell($table->getCoordinate())->getHyperlink()->getUrl());

        // Text color should be blue
        $sheet->cell($table->getCoordinate(), function ($cell) {
            $this->assertEquals('0000ff', $cell->font()->getColor());
        });
    }

    /**
     * @return \Maatwebsite\Clerk\Excel\Sheet
     */
    public function mockSheet()
    {
        return new Sheet(new Workbook('title'), 'title');
    }
}
