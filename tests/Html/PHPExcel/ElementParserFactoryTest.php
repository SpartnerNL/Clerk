<?php namespace Maatwebsite\Clerk\Tests\Html\PHPExcel;

use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ElementParserFactory;

class ElementParserFactoryTest extends \PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        \Mockery::close();
    }

    public function test_factory_returns_right_element()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements\TrElement', ElementParserFactory::create('tr', $this->mockSheet()));
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements\TdElement', ElementParserFactory::create('td', $this->mockSheet()));
        $this->assertInstanceOf('Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements\ThElement', ElementParserFactory::create('th', $this->mockSheet()));
    }


    protected function mockSheet()
    {
        return \Mockery::mock('Maatwebsite\Clerk\Sheet')->makePartial();
    }
}