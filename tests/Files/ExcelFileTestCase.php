<?php

trait ExcelFileTestCase {

    public function test_initializing_file()
    {
        $excel = new $this->class('Workbook title');

        $this->assertInstanceOf($this->class, $excel);
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Workbook', $excel->getWorkbook());
        $this->assertEquals('Workbook title', $excel->getWorkbook()->getTitle());
    }


    public function test_using_the_callback()
    {
        $excel = new $this->class('Workbook title', function ($workbook)
        {
            $workbook->setTitle('overruled');
        });

        $this->assertInstanceOf($this->class, $excel);
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Workbook', $excel->getWorkbook());
        $this->assertEquals('overruled', $excel->getWorkbook()->getTitle());
    }


    public function test_create_a_new_file()
    {
        $class = $this->class;
        $excel = $class::create('Workbook title', null, '');

        $this->assertInstanceOf($this->class, $excel);
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Workbook', $excel->getWorkbook());
        $this->assertEquals('Workbook title', $excel->getWorkbook()->getTitle());
    }


    public function test_get_extension()
    {
        $excel = new $this->class('Workbook title');
        $this->assertEquals($this->ext, $excel->getExtension());
    }


    public function test_minimum_amount_of_sheets_needed()
    {
        $this->setExpectedException('Maatwebsite\Clerk\Exceptions\ExportFailedException');
        $excel = new $this->class('Workbook title');
        $excel->export();
    }

    public function test_load()
    {
        $class = $this->class;
        $excel = $class::load(__DIR__ . '/import/test.' . $this->ext, null, '');

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Reader', $excel);
    }
}
