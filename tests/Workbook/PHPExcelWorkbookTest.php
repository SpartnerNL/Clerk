<?php namespace Maatwebsite\Clerk\Tests\Workbook;

use Mockery as m;
use Maatwebsite\Clerk\Adapters\PHPExcel\Sheet;
use Maatwebsite\Clerk\Adapters\PHPExcel\Workbook;

class PHPExcelWorkbookTest extends \PHPUnit_Framework_TestCase {


    public function tearDown()
    {
        m::close();
    }


    public function test_initializing_a_new_workbook()
    {
        $workbook = new Workbook('Workbook title');
        $this->assertInstanceOf('Maatwebsite\Clerk\Workbook', $workbook);
    }


    public function test_setting_a_new_workbook_title()
    {
        $workbook = new Workbook('Workbook title');
        $this->assertEquals('Workbook title', $workbook->getTitle());

        $workbook->setTitle('Overruled');
        $this->assertEquals('Overruled', $workbook->getTitle());
    }


    public function test_setting_title_through_the_callback()
    {
        $workbook = new Workbook('Workbook title', function ($workbook)
        {
            $workbook->setTitle('From closure');
        });

        $this->assertEquals('From closure', $workbook->getTitle());
    }


    public function test_add_a_new_sheet()
    {
        $workbook = new Workbook('Workbook title');
        $sheet = new Sheet($workbook, 'Sheet title');
        $workbook->addSheet($sheet);

        $this->assertCount(1, $workbook->getSheets());
    }


    public function test_create_new_sheet_on_workbook()
    {
        $workbook = new Workbook('Workbook title');
        $workbook->sheet('sheet title');

        $this->assertCount(1, $workbook->getSheets());
    }


    public function test_create_new_sheet_on_workbook_with_closure()
    {
        $workbook = new Workbook('Workbook title', function ($workbook)
        {
            $workbook->sheet('sheet title');
        });

        $this->assertCount(1, $workbook->getSheets());
    }


    public function test_create_new_sheet_with_closure_on_workbook()
    {
        $workbook = new Workbook('Workbook title');

        $workbook->sheet('sheet title', function ($sheet)
        {
            $sheet->setTitle('overruled');
        });

        $this->assertCount(1, $workbook->getSheets());
        $this->assertEquals('overruled', $workbook->getSheetByIndex(0)->getTitle());
    }


    public function test_sheet_exists()
    {
        $workbook = new Workbook('Workbook title');
        $workbook->sheet('sheet title');

        $this->assertTrue($workbook->sheetExists(0));
        $this->assertFalse($workbook->sheetExists(1));
    }


    public function test_is_valid_sheet_index()
    {
        $workbook = new Workbook('Workbook title');

        // All integers
        $this->assertTrue($workbook->isValidIndex(0));
        $this->assertTrue($workbook->isValidIndex(1));

        // Integers given as string
        $this->assertTrue($workbook->isValidIndex('1000'));

        // No strings
        $this->assertFalse($workbook->isValidIndex('invalid'));

        // No decimals
        $this->assertFalse($workbook->isValidIndex('0.555'));
    }


    public function test_existing_sheet_by_index()
    {
        $workbook = new Workbook('Workbook title');
        $sheet = new Sheet($workbook, 'Sheet title');
        $workbook->addSheet($sheet);

        $this->assertEquals($sheet, $workbook->getSheetByIndex('0'));
    }


    public function test_get_sheet_by_index_with_invalid_index()
    {
        $workbook = new Workbook('Workbook title');

        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\InvalidArgumentException');
        $workbook->getSheetByIndex('invalid');
    }


    public function test_non_existing_sheet_by_index()
    {
        $workbook = new Workbook('Workbook title');

        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\SheetNotFoundException');
        $workbook->getSheetByIndex(2);
    }


    public function test_get_sheet_collection()
    {
        $workbook = new Workbook('Workbook title');
        $sheet = $workbook->sheet('sheet title');

        $this->assertCount(1, $workbook->getSheets());
        $this->assertContains($sheet, $workbook->getSheets());
    }


    public function test_get_sheet_count()
    {
        $workbook = new Workbook('Workbook title');
        $this->assertEquals(0, $workbook->getSheetCount());

        $workbook->sheet('sheet title');
        $this->assertEquals(1, $workbook->getSheetCount());

        $workbook->sheet('sheet title');
        $workbook->sheet('sheet title');
        $this->assertEquals(3, $workbook->getSheetCount());
    }


    public function test_remove_a_sheet_by_index()
    {
        $workbook = new Workbook('Workbook title');
        $workbook->sheet('sheet title');

        $this->assertEquals(1, $workbook->getSheetCount());

        $workbook->removeSheetByIndex(0);

        $this->assertEquals(0, $workbook->getSheetCount());
    }


    private function getPHPExcelMock()
    {
        return m::mock('PHPExcel');
    }
}