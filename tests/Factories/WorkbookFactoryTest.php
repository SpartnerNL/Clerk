<?php namespace Maatwebsite\Clerk\Tests\Factories;

use Maatwebsite\Clerk\Factories\WorkbookFactory;

class WorkbookFactoryTest extends \PHPUnit_Framework_TestCase {

    public function test_factory_returns_workbook()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Workbook', WorkbookFactory::create('PHPExcel', 'title'));
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Workbook', WorkbookFactory::create('PHPExcel', 'title'));

        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\LeagueCsv\Workbook', WorkbookFactory::create('LeagueCsv', 'title'));
    }


    public function test_factory_returns_exception_when_trying_to_use_nonexisting_driver()
    {
        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\DriverNotFoundException');
        WorkbookFactory::create('TEST', 'title');
    }
}