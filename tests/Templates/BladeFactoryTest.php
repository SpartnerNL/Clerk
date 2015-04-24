<?php

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Adapters\Blade\BladeFactory;

class BladeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Ledger::set('templates.path', __DIR__ . '/files');
        Ledger::set('templates.cache', __DIR__ . '/files/.cache');
    }

    public function test_render_a_template()
    {
        $factory = new BladeFactory();

        $html = $factory->make('excel', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', trim($html));

        $html = $factory->make('excel.blade', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', trim($html));

        $html = $factory->make('excel.blade.php', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', trim($html));
    }
}
