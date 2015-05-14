<?php

use Maatwebsite\Clerk\Drivers\LeagueCsv;
use Maatwebsite\Clerk\Drivers\PHPExcel;
use Maatwebsite\Clerk\Excel\Readers\ReaderFactory;

class ReaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_factory_returns_reader()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Readers\Reader', ReaderFactory::create(new PHPExcel('drivers.reader.excel2003'), 'test.xls', null, 'Excel5'));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Readers\Reader', ReaderFactory::create(new PHPExcel('drivers.reader.excel2007'), 'test.xlsx', null, 'Excel2007'));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\LeagueCsv\Readers\CsvReader', ReaderFactory::create(new LeagueCsv('drivers.reader.csv'), 'test.csv', null, 'CSV'));
    }

    public function test_that_factory_can_guess_the_file_type()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Readers\Reader', ReaderFactory::create(new PHPExcel('drivers.reader.excel2003'), __DIR__ . '/files/test.xls'));
    }
}
