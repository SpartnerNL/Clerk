<?php namespace Maatwebsite\Clerk\Tests\Excel\Identifiers;

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Identifiers\FormatIdentifier;

class PHPExcelFormatIdentifierTest extends \PHPUnit_Framework_TestCase {


    public function test_get_format_by_extension()
    {
        $identifier = new FormatIdentifier();
        $this->assertEquals('CSV', $identifier->getFormatByExtension('csv'));
        $this->assertEquals('Excel5', $identifier->getFormatByExtension('xls'));
        $this->assertEquals('Excel2007', $identifier->getFormatByExtension('xlsx'));
        $this->assertEquals('HTML', $identifier->getFormatByExtension('html'));
        $this->assertEquals('Excel2003XML', $identifier->getFormatByExtension('xml'));
    }


    public function test_get_format_by_file()
    {
        $identifier = new FormatIdentifier();
        $csv = __DIR__ . '/files/test.csv';
        $xls = __DIR__ . '/files/test.xls';
        $xlsx = __DIR__ . '/files/test.xlsx';
        $htm = __DIR__ . '/files/test.htm';
        $xml = __DIR__ . '/files/test.xml';

        $this->assertEquals('CSV', $identifier->getFormatByFile($csv));
        $this->assertEquals('Excel5', $identifier->getFormatByFile($xls));
        $this->assertEquals('Excel2007', $identifier->getFormatByFile($xlsx));
        $this->assertEquals('HTML', $identifier->getFormatByFile($htm));
        $this->assertEquals('Excel2003XML', $identifier->getFormatByFile($xml));
    }


    public function test_get_content_type_by_format()
    {
        $identifier = new FormatIdentifier();
        $this->assertContains('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8', $identifier->getContentTypeByFormat('Excel2007'));
        $this->assertContains('application/vnd.ms-excel; charset=UTF-8', $identifier->getContentTypeByFormat('Excel5'));
        $this->assertContains('application/csv; charset=UTF-8', $identifier->getContentTypeByFormat('CSV'));
    }
}