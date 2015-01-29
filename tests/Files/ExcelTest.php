<?php namespace Maatwebsite\Clerk\Tests\Files;

use Maatwebsite\Clerk\Files\Excel;

class ExcelTest extends \PHPUnit_Framework_TestCase {


    public function test_initializing_a_new_excel2003_file()
    {
        $excel = new Excel('Workbook title');

        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Excel', $excel);
        $this->assertInstanceOf('Maatwebsite\Clerk\Workbook', $excel->getWorkbook());
        $this->assertEquals('Workbook title', $excel->getWorkbook()->getTitle());
    }


    public function test_using_the_callback()
    {
        $excel = new Excel('Workbook title', function ($workbook)
        {
            $workbook->setTitle('overruled');
        });

        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Excel', $excel);
        $this->assertInstanceOf('Maatwebsite\Clerk\Workbook', $excel->getWorkbook());
        $this->assertEquals('overruled', $excel->getWorkbook()->getTitle());
    }
}