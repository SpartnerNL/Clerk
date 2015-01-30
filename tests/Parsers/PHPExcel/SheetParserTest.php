<?php namespace Maatwebsite\Clerk\Tests\Parsers\PHPExcel;

use Maatwebsite\Clerk\Adapters\ParserSettings;
use Maatwebsite\Clerk\Adapters\PHPExcel\Parsers\SheetParser;

class SheetParserTest extends \PHPUnit_Framework_TestCase {


    public function test_parse_with_heading_enabled()
    {
        $settings = new ParserSettings();
        $parser = new SheetParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertInstanceOf('Maatwebsite\Clerk\Collections\RowCollection', $parsed);
        $this->assertEquals('mocked', $parsed->getTitle());

        // Two rows, but one is used as heading
        $this->assertCount(1, $parsed);
    }


    public function test_parse_with_no_heading()
    {
        $settings = new ParserSettings();
        $settings->setHasHeading(false);

        $parser = new SheetParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertInstanceOf('Maatwebsite\Clerk\Collections\RowCollection', $parsed);
        $this->assertEquals('mocked', $parsed->getTitle());

        $this->assertCount(2, $parsed);
    }


    public function test_parse_with_different_start_row()
    {
        $settings = new ParserSettings();
        $settings->setHasHeading(false);
        $settings->setStartRow(2);

        $parser = new SheetParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertInstanceOf('Maatwebsite\Clerk\Collections\RowCollection', $parsed);
        $this->assertEquals('mocked', $parsed->getTitle());

        $this->assertCount(1, $parsed);
    }


    public function test_parse_with_max_rows()
    {
        $settings = new ParserSettings();
        $settings->setHasHeading(false);
        $settings->setMaxRows(1);

        $parser = new SheetParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertInstanceOf('Maatwebsite\Clerk\Collections\RowCollection', $parsed);
        $this->assertEquals('mocked', $parsed->getTitle());

        $this->assertCount(1, $parsed);
    }


    /**
     * @return \PHPExcel_Worksheet
     */
    protected function mockSheet()
    {
        $workbook = new \PHPExcel();
        $workbook->disconnectWorksheets();

        $sheet = new \PHPExcel_Worksheet($workbook);
        $sheet->setTitle('mocked');

        $sheet->fromArray([
            ['a1', 'b1'],
            ['a2', 'b2']
        ]);

        return $sheet;
    }
}