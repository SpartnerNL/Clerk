<?php namespace Maatwebsite\Clerk\Tests\Factories;

use Maatwebsite\Clerk\Factories\ReaderFactory;

class ReaderFactoryTest extends \PHPUnit_Framework_TestCase {

    public function test_factory_returns_writer()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Readers\Reader', ReaderFactory::create('PHPExcel', 'test.xls', null, 'Excel5'));
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Readers\Reader', ReaderFactory::create('PHPExcel', 'test.xlsx', null, 'Excel2007'));
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\LeagueCsv\Readers\CsvReader', ReaderFactory::create('LeagueCsv', 'test.csv', null, 'CSV'));
    }


    public function test_factory_returns_exception_when_trying_to_use_nonexisting_driver()
    {
        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\DriverNotFoundException');
        ReaderFactory::create('TEST', __DIR__ . '/import/test.xls');
    }


    public function test_that_factory_can_guess_the_file_type()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Readers\Reader', ReaderFactory::create('PHPExcel', __DIR__ . '/import/test.xls'));
    }
}