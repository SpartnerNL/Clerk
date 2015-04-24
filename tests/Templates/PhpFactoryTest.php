<?php

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Adapters\Php\PhpFactory;

class PhpFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function setUp()
    {
        Ledger::set('templates.path', __DIR__ . '/files');
    }


    public function test_render_a_template()
    {
        $factory = new PhpFactory();

        $html = $factory->make('excel', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', $html);

        $html = $factory->make('excel.php', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', $html);
    }
}
