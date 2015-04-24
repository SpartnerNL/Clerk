<?php

use Maatwebsite\Clerk\Ledger;

class LedgerTest extends \PHPUnit_Framework_TestCase
{
    public function test_get()
    {
        $this->assertEquals('PHPExcel', Ledger::getInstance()->getConfig('drivers.excel2003'));
        $this->assertEquals('PHPExcel', Ledger::get('drivers.excel2003'));
    }

    public function test_set()
    {
        Ledger::set('drivers.excel2003', 'TEST');
        $this->assertEquals('TEST', Ledger::get('drivers.excel2003'));
    }

    public function test_default_get()
    {
        $this->assertEquals('default', Ledger::get('non-found', 'default'));
    }

    public function test_default_has()
    {
        $this->assertTrue(Ledger::has('drivers.excel2003'));
        $this->assertFalse(Ledger::has('not-found'));
    }
}
