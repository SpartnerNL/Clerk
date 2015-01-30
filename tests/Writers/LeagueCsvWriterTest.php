<?php namespace Maatwebsite\Clerk\Tests\Writers;

use Maatwebsite\Clerk\Adapters\LeagueCsv\Writers\CsvWriter;
use Mockery as m;

class LeagueCsvWriterTest extends \PHPUnit_Framework_TestCase {


    public function setUp()
    {
        parent::setUp();

        $this->workbook = m::mock('Maatwebsite\Clerk\Workbook');
    }


    public function tearDown()
    {
        m::close();
    }


    public function test_can_init()
    {
        $writer = new CsvWriter('CSV', 'csv', $this->workbook);

        $this->assertInstanceOf('Maatwebsite\Clerk\Writer', $writer);
    }

}