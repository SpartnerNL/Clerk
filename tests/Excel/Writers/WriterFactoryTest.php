<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Writers\WriterFactory;

class WriterFactoryTest extends \PHPUnit_Framework_TestCase {

    public function test_factory_returns_writer()
    {
        $workbook = new Workbook('mock');
        $workbook->sheet('mock');

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\Writer', WriterFactory::create('PHPExcel', 'Excel5', 'xls', $workbook));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\Writer', WriterFactory::create('PHPExcel', 'Excel2007', 'xlsx', $workbook));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\LeagueCsv\Writers\CsvWriter', WriterFactory::create('LeagueCsv', 'Csv', 'csv', $workbook));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\CsvWriter', WriterFactory::create('PHPExcel', 'Csv', 'csv', $workbook));
    }


    public function test_factory_returns_exception_when_trying_to_use_nonexisting_driver()
    {
        $workbook = new Workbook('mock');
        $workbook->sheet('mock');

        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\DriverNotFoundException');
        WriterFactory::create('TEST', 'title', 'csv', $workbook);
    }


    public function test_factory_returns_exception_when_trying_to_use_it_without_sheets()
    {
        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\ExportFailedException');

        $workbook = new Workbook('mock');
        WriterFactory::create('PHPExcel', 'Excel5', 'xls', $workbook);
    }
}
