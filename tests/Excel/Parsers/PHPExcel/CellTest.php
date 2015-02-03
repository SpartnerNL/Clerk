<?php namespace Maatwebsite\Clerk\Tests\Excel\Parsers\PHPExcel;

use Maatwebsite\Clerk\Excel\Readers\ParserSettings;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Cell;

class CellTest extends \PHPUnit_Framework_TestCase {

    public function test_init_cell()
    {
        $cell = $this->mockCell();

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Cell', $cell);
        $this->assertInstanceOf('\PHPExcel_Cell', $cell->getCell());
    }


    public function test_getting_value()
    {
        $cell = $this->mockCell();
        $this->assertEquals('text', $cell->getValue());
        $this->assertEquals('text', (string) $cell);
    }


    public function test_getting_calculated_value()
    {
        $cell = $this->mockCell('=1+1');
        $this->assertEquals('2', $cell->getCalculatedValue());
        $this->assertEquals('2', (string) $cell);
    }


    public function test_getting_date_value()
    {
        $settings = new ParserSettings();

        $cell = $this->mockCell('39682');
        $this->assertInstanceOf('Carbon\Carbon', $cell->getDateValue());

        $settings->setNeedsDateFormatting(false);
        $cell = $this->mockCell('39682', $settings);
        $this->assertEquals('39682', $cell->getDateValue());

        $settings->setNeedsDateFormatting(true);
        $settings->setDateFormat('d-m-Y');
        $cell = $this->mockCell('39682', $settings);
        $this->assertEquals('22-08-2008', $cell->getDateValue());
    }


    /**
     * @param string $text
     * @return Cell
     */
    protected function mockCell($text = 'text', $settings = false)
    {
        $workbook = new \PHPExcel();
        $workbook->disconnectWorksheets();

        $worksheet = new \PHPExcel_Worksheet($workbook);
        $workbook->addSheet($worksheet);

        $cell = $worksheet->setCellValue('A1', $pValue = $text, $returnCell = true);

        $settings = $settings ?: new ParserSettings();
        $cell = new Cell($cell, 1, $settings);

        return $cell;
    }
}