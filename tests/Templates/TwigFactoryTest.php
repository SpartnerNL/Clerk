<?php namespace Maatwebsite\Clerk\Tests\Templates;

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Adapters\Twig\TwigFactory;

class TwigFactoryTest extends \PHPUnit_Framework_TestCase {


    public function setUp()
    {
        Ledger::set('templates.path', __DIR__ . '/files');
        Ledger::set('templates.cache', __DIR__ . '/files/.cache');
    }


    public function test_render_a_template()
    {
        $factory = new TwigFactory();

        $html = $factory->make('excel', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', $html);

        $html = $factory->make('excel.html', ['name' => 'Patrick'])->render();
        $this->assertEquals('<p>Patrick</p>', $html);
    }
}