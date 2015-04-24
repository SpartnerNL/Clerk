<?php

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Adapters\Smarty\SmartyFactory;

class SmartyFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Ledger::set('templates.path', __DIR__ . '/files');
        Ledger::set('templates.cache', __DIR__ . '/files/.cache');
        Ledger::set('templates.compile', __DIR__ . '/files/.cache');
        Ledger::set('templates.config', __DIR__ . '/files/.cache');
    }

    public function test_render_a_template()
    {
        $factory = new SmartyFactory();

        $html = $factory->make('excel', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', $html);

        $html = $factory->make('excel.tpl', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', $html);
    }
}
