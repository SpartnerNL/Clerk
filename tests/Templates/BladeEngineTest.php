<?php

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Adapters\Blade\BladeEngine;

class BladeEngineTest extends \PHPUnit_Framework_TestCase {


    public function test_render_a_template()
    {
        $engine = (new BladeEngine(
            Ledger::get('templates.path'),
            Ledger::get('templates.cache')
        ));

        $this->assertInstanceOf('Illuminate\Contracts\View\Factory', $engine->getFactory());
    }
}
