<?php

use Maatwebsite\Clerk\Templates\Css\CssInliner;

class CssInlinerTest extends \PHPUnit_Framework_TestCase
{
    public function test_inline_style_blocks_get_inlined()
    {
        $html = '<style>
            table {
                background: #000000;
            }
        </style>
        <table></table>';

        $inliner = new CssInliner();
        $inlined = $inliner->transformCssToInlineStyles($html);

        $this->assertEquals('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html><head><style></style></head><body><table style="background: #000000;"></table></body></html>
', $inlined);
    }

    public function test_css_from_style_sheets_links_get_inlined()
    {
        $html = '<link href="' . __DIR__ . '/css/' . 'style.css" rel="stylesheet">
        <table></table>';

        $inliner = new CssInliner();
        $inlined = $inliner->transformCssToInlineStyles($html);

        $this->assertEquals('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html><head><link href="' . __DIR__ . '/css/' . 'style.css" rel="stylesheet"></head><body><table style="background: #000000;"></table></body></html>
', $inlined);
    }
}
