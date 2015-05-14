<?php

use Maatwebsite\Clerk\Drivers\LeagueCsv;
use Maatwebsite\Clerk\Drivers\PHPExcel;
use Maatwebsite\Clerk\Excel\Workbooks\WorkbookFactory;

class WorkbookFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_factory_returns_workbook()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Workbook', WorkbookFactory::create(new PHPExcel('drivers.writer.excel2003'), 'title'));
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Workbook', WorkbookFactory::create(new PHPExcel('drivers.writer.excel2003'), 'title'));

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Adapters\LeagueCsv\Workbook', WorkbookFactory::create(new LeagueCsv('drivers.writer.csv'), 'title'));
    }
}
