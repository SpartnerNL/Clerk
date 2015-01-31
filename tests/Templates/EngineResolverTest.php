<?php namespace Maatwebsite\Clerk\Tests\Templates;

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\EngineResolver;

class EngineResolverTest extends \PHPUnit_Framework_TestCase {


    public function test_identify_based_on_extension()
    {
        $this->assertEquals('php', (new EngineResolver('excel.php'))->getEngine());
        $this->assertEquals('smarty', (new EngineResolver('excel.tpl'))->getEngine());
        $this->assertEquals('blade', (new EngineResolver('excel.blade'))->getEngine());
        $this->assertEquals('blade', (new EngineResolver('excel.blade.php'))->getEngine());
        $this->assertEquals('twig', (new EngineResolver('excel.html'))->getEngine());
    }


    public function test_identify_with_passing_the_right_engine()
    {
        $this->assertEquals('smarty', (new EngineResolver('excel', 'smarty'))->getEngine());
    }


    public function test_overruling_engine_extensions_defaults()
    {
        Ledger::set('templates.engines.blade', '.laravel');
        $this->assertEquals('blade', (new EngineResolver('excel.laravel'))->getEngine());
    }


    public function test_overruling_engine_extensions_with_multiple_extension_possibilities()
    {
        Ledger::set('templates.engines.smarty', [
            '.tpl',
            '.tmpl',
            '.smarty'
        ]);
        $this->assertEquals('smarty', (new EngineResolver('excel.tpl'))->getEngine());
        $this->assertEquals('smarty', (new EngineResolver('excel.tmpl'))->getEngine());
        $this->assertEquals('smarty', (new EngineResolver('excel.smarty'))->getEngine());
    }


    public function test_identify_based_on_default()
    {
        $this->assertEquals('php', (new EngineResolver('excel'))->getEngine());

        Ledger::set('templates.default', 'blade');
        $this->assertEquals('blade', (new EngineResolver('excel'))->getEngine());
    }
}