<?php namespace Maatwebsite\Clerk\Tests\Html\PHPExcel;

use Maatwebsite\Clerk\Adapters\PHPExcel\Html\HtmlToSheetConverter;

class HtmlToSheetConverterTest extends \PHPUnit_Framework_TestCase {


    public function tearDown()
    {
        \Mockery::close();
    }


    public function test_convert_html_to_sheet()
    {
        $converter = new HtmlToSheetConverter();

        $sheet = $converter->convert('<table><tr><td>Patrick</td></tr></table>', $this->mockSheet());
        $this->assertInstanceOf('Maatwebsite\Clerk\Sheet', $sheet);
    }


    public function mockSheet()
    {
        $sheet = \Mockery::mock('Maatwebsite\Clerk\Sheet')->makePartial();
        $sheet->shouldReceive('cell')->with('A1', 'Patrick')->once();

        return $sheet;
    }
}