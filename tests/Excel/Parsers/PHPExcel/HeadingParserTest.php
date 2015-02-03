<?php namespace Maatwebsite\Clerk\Tests\Excel\Parsers\PHPExcel;

use Maatwebsite\Clerk\Excel\Readers\ParserSettings;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers\HeadingParser;

class HeadingParserTest extends \PHPUnit_Framework_TestCase {


    public function test_parse_with_heading_with_default_settings()
    {
        $settings = new ParserSettings();
        $parser = new HeadingParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertTrue(is_array($parsed));
        $this->assertCount(2, $parsed);
        $this->assertContains('name', $parsed);
        $this->assertContains('date_of_birth', $parsed);
    }


    public function test_parse_with_heading_with_ascii()
    {
        $settings = new ParserSettings();
        $settings->setHeadingType('ascii');

        $parser = new HeadingParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertTrue(is_array($parsed));
        $this->assertCount(2, $parsed);
        $this->assertContains('Name', $parsed);
        $this->assertContains('Date of Birth', $parsed);
    }


    public function test_parse_with_heading_with_hashed()
    {
        $settings = new ParserSettings();
        $settings->setHeadingType('hashed');

        $parser = new HeadingParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertTrue(is_array($parsed));
        $this->assertCount(2, $parsed);
        $this->assertContains(md5('Name'), $parsed);
        $this->assertContains(md5('Date of Birth'), $parsed);
    }


    public function test_parse_with_heading_with_original()
    {
        $settings = new ParserSettings();
        $settings->setHeadingType('original');

        $parser = new HeadingParser($settings);

        $parsed = $parser->parse($this->mockSheet());

        $this->assertTrue(is_array($parsed));
        $this->assertCount(2, $parsed);
        $this->assertContains('Name', $parsed);
        $this->assertContains('Date of Birth', $parsed);
    }


    /**
     * @return \PHPExcel_Worksheet
     */
    protected function mockSheet()
    {
        $workbook = new \PHPExcel();
        $workbook->disconnectWorksheets();

        $sheet = new \PHPExcel_Worksheet($workbook);
        $sheet->setTitle('mocked');

        $sheet->fromArray([
            ['Name', 'Date of Birth'],
            ['a2', 'b2']
        ]);

        return $sheet;
    }
}