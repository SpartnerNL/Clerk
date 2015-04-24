<?php

use Maatwebsite\Clerk\Excel\Workbooks\WorkbookFactory;

class WorkbookFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_factory_returns_workbook()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Workbook', WorkbookFactory::create('PHPExcel', 'title'));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook', WorkbookFactory::create('PHPExcel', 'title'));

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\LeagueCsv\Workbook', WorkbookFactory::create('LeagueCsv', 'title'));
    }

    public function test_factory_returns_exception_when_trying_to_use_nonexisting_driver()
    {
        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\DriverNotFoundException');
        WorkbookFactory::create('TEST', 'title');
    }
}
