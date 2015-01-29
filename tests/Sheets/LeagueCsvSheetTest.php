<?php namespace Maatwebsite\Clerk\Tests\Sheets;

use Mockery as m;
use Maatwebsite\Clerk\Adapters\LeagueCsv\Sheet;
use Maatwebsite\Clerk\Adapters\LeagueCsv\Workbook;

class LeagueCsvSheetTest extends \PHPUnit_Framework_TestCase {


    public function tearDown()
    {
        m::close();
    }


    public function test_initializing_a_new_workbook()
    {
        $workbook = new Workbook('Workbook');
        $sheet = new Sheet($workbook, 'Sheet title');
        $this->assertInstanceOf('Maatwebsite\Clerk\Sheet', $sheet);
    }


    public function test_setting_a_new_workbook_title()
    {
        $workbook = new Workbook('Workbook');
        $sheet = new Sheet($workbook, 'Sheet title');
        $this->assertEquals('Sheet title', $sheet->getTitle());

        $sheet->setTitle('Overruled');
        $this->assertEquals('Overruled', $sheet->getTitle());
    }


    public function test_setting_title_through_the_callback()
    {
        $workbook = new Workbook('Workbook');
        $sheet = new Sheet($workbook, 'Sheet title', function ($sheet)
        {
            $sheet->setTitle('From closure');
        });

        $this->assertEquals('From closure', $sheet->getTitle());
    }
}