<?php namespace Maatwebsite\Clerk\Tests\Factories;

use Maatwebsite\Clerk\Adapters\PHPExcel\Workbook;
use Maatwebsite\Clerk\Factories\WriterFactory;

class WriterFactoryTest extends \PHPUnit_Framework_TestCase {

    public function test_factory_returns_writer()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Writer', WriterFactory::create('PHPExcel', 'Excel5', 'xls', new Workbook('mock')));
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Writer', WriterFactory::create('PHPExcel', 'Excel2007', 'xlsx', new Workbook('mock')));
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\LeagueCsv\Writer', WriterFactory::create('LeagueCsv', 'Csv', 'csv', new Workbook('mock')));
    }
}