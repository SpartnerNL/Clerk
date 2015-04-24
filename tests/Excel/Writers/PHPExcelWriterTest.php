<?php

use Mockery as m;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\Writer;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\CsvWriter;

class PHPExcelWriterTest extends \PHPUnit_Framework_TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->workbook = m::mock('Maatwebsite\Clerk\Excel\Workbook');
    }


    public function tearDown()
    {
        m::close();
    }


    public function test_can_init()
    {
        $writer = new Writer('CSV', 'csv', $this->workbook);

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Writer', $writer);
    }


    public function test_get_content_type()
    {
        $writer = new Writer('CSV', 'csv', $this->workbook);
        $this->assertContains('application/csv; charset=UTF-8', $writer->getContentType('CSV'));

        $writer = new CsvWriter('CSV', 'csv', $this->workbook);
        $this->assertContains('application/csv; charset=UTF-8', $writer->getContentType('CSV'));

        $writer = new Writer('Excel5', 'xls', $this->workbook);
        $this->assertContains('application/vnd.ms-excel; charset=UTF-8', $writer->getContentType('Excel5'));

        $writer = new Writer('Excel2007', 'xlsx', $this->workbook);
        $this->assertContains('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8', $writer->getContentType('Excel2007'));
    }
}
