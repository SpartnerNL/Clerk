<?php

use Maatwebsite\Clerk\Templates\Css\StylesheetExtractor;

class StylesheetExtractorTest extends \PHPUnit_Framework_TestCase {


    public function test_extracting_stylesheets_from_html()
    {
        $html = '<link href="' . __DIR__ . '/css/' . 'style.css" rel="stylesheet"><link href="' . __DIR__ . '/css/' . 'style1.css" rel="stylesheet"><link href="' . __DIR__ . '/css/' . 'style2.css" rel="stylesheet">';

        $extractor = new StylesheetExtractor($html);
        $result = $extractor->extract();

        $this->assertCount(3, $result);
    }


    public function test_extracting_stylesheets_returns_the_css()
    {
        $html = '<link href="' . __DIR__ . '/css/' . 'style.css" rel="stylesheet">';

        $extractor = new StylesheetExtractor($html);
        $result = $extractor->extract();

        $this->assertEquals('table { background: #000000; }', $result[__DIR__ . '/css/' . 'style.css']);
    }
}
