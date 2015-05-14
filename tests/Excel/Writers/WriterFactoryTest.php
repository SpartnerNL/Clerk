<?php

use Maatwebsite\Clerk\Drivers\LeagueCsv;
use Maatwebsite\Clerk\Drivers\PHPExcel;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Excel\Writers\WriterFactory;

class WriterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_factory_returns_writer()
    {
        $workbook = new Workbook('mock');
        $workbook->sheet('mock');

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\Writer', WriterFactory::create(new PHPExcel('drivers.writer.excel2003'), 'Excel5', 'xls', $workbook));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\Writer', WriterFactory::create(new PHPExcel('drivers.writer.excel2007'), 'Excel2007', 'xlsx', $workbook));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\LeagueCsv\Writers\CsvWriter', WriterFactory::create(new LeagueCsv('drivers.writer.csv'), 'Csv', 'csv', $workbook));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers\CsvWriter', WriterFactory::create(new PHPExcel('drivers.writer.csv'), 'Csv', 'csv', $workbook));
    }

    public function test_factory_returns_exception_when_trying_to_use_it_without_sheets()
    {
        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\ExportFailedException');

        $workbook = new Workbook('mock');
        WriterFactory::create(new PHPExcel('drivers.writer.excel2003'), 'Excel5', 'xls', $workbook);
    }
}
