<?php namespace Maatwebsite\Clerk\Tests\Parsers\PHPExcel;

use Maatwebsite\Clerk\Adapters\ParserSettings;
use Maatwebsite\Clerk\Adapters\PHPExcel\Parsers\WorkbookParser;

class WorkbookParserTest extends \PHPUnit_Framework_TestCase {

    public function test_parse()
    {
        $settings = new ParserSettings();
        $parser = new WorkbookParser($settings);

        $parsed = $parser->parse($this->mockWorkbook());

        $this->assertInstanceOf('Maatwebsite\Clerk\Collections\SheetCollection', $parsed);
        $this->assertEquals('mocked', $parsed->getTitle());
        $this->assertCount(2, $parsed);
    }


    public function test_parse_with_selected_sheets()
    {
        $settings = new ParserSettings();
        $settings->setSheetIndices([1]);

        $parser = new WorkbookParser($settings);

        $parsed = $parser->parse($this->mockWorkbook());

        $this->assertInstanceOf('Maatwebsite\Clerk\Collections\SheetCollection', $parsed);
        $this->assertEquals('mocked', $parsed->getTitle());
        $this->assertCount(1, $parsed);
    }


    /**
     * @return \PHPExcel
     */
    protected function mockWorkbook()
    {
        $workbook = new \PHPExcel();
        $workbook->disconnectWorksheets();

        $workbook->getProperties()->setTitle('mocked');
        $workbook->addSheet(new \PHPExcel_Worksheet($workbook));
        $workbook->addSheet(new \PHPExcel_Worksheet($workbook));

        return $workbook;
    }
}