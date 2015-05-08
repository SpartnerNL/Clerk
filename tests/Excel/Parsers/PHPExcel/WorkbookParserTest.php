<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers\WorkbookParser;
use Maatwebsite\Clerk\Excel\Readers\ParserSettings;

class WorkbookParserTest extends \PHPUnit_Framework_TestCase
{
    public function test_parse()
    {
        $settings = new ParserSettings();
        $parser = new WorkbookParser($settings);

        $parsed = $parser->parse($this->mockWorkbook());

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Collections\SheetCollection', $parsed);
        $this->assertEquals('mocked', $parsed->getTitle());
        $this->assertCount(2, $parsed);
    }

    public function test_parse_with_selected_sheets()
    {
        $settings = new ParserSettings();
        $settings->setSheetIndices([1]);

        $parser = new WorkbookParser($settings);

        $parsed = $parser->parse($this->mockWorkbook());

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Collections\SheetCollection', $parsed);
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

        $sheet = new \PHPExcel_Worksheet($workbook);
        $sheet->fromArray([
            [
                'test',
                'test',
                'test'
            ],
            [
                'test',
                'test',
                'test'
            ],
            [
                'test',
                'test',
                'test'
            ],
            [
                'test',
                'test',
                'test'
            ]
        ]);
        $workbook->addSheet($sheet);

        $sheet = new \PHPExcel_Worksheet($workbook);
        $sheet->fromArray([
            [
                'test',
                'test',
                'test'
            ],
            [
                'test',
                'test',
                'test'
            ],
            [
                'test',
                'test',
                'test'
            ],
            [
                'test',
                'test',
                'test'
            ]
        ]);
        $workbook->addSheet($sheet);

        $workbook->setActiveSheetIndex(0);

        return $workbook;
    }
}
