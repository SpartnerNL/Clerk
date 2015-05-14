<?php

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Readers\Reader;

class PHPExcelReaderTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_init()
    {
        $reader = $this->getReader();
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Reader', $reader);
    }

    public function test_can_get_and_set_settings()
    {
        $reader = $this->getReader();

        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Readers\ParserSettings', $reader->settings());
        $reader->settings()->setStartRow(2);

        $this->assertEquals(2, $reader->settings()->getStartRow());
    }

    public function test_take()
    {
        $reader = $this->getReader();

        $reader->take(10);

        // Max rows should always one more!
        $this->assertEquals(11, $reader->settings()->getMaxRows());
    }

    public function test_skip()
    {
        $reader = $this->getReader();

        $reader->skip(10);
        $this->assertEquals(10, $reader->settings()->getStartRow());
    }

    public function test_limit()
    {
        $reader = $this->getReader();

        $reader->limit(10, 10);

        $this->assertEquals(10, $reader->settings()->getStartRow());
        $this->assertEquals(11, $reader->settings()->getMaxRows());
    }

    public function test_select()
    {
        $reader = $this->getReader();

        $reader->select(['name']);
        $this->assertEquals(['name'], $reader->settings()->getColumns());
    }

    public function test_get_with_columns()
    {
        $reader = $this->getReader();

        $reader->get(['name']);
        $this->assertEquals(['name'], $reader->settings()->getColumns());
    }

    public function test_get()
    {
        $reader = $this->getReader();
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Collections\SheetCollection', $reader->get());
    }

    public function test_all()
    {
        $reader = $this->getReader();
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Collections\SheetCollection', $reader->all());
    }

    public function test_first()
    {
        $reader = $this->getReader();
        $this->assertInstanceOf('Maatwebsite\Clerk\Excel\Collections\RowCollection', $reader->first());
    }

    public function test_to_array()
    {
        $reader = $this->getReader();
        $this->assertTrue(is_array($reader->toArray()));
    }

    public function test_select_sheets()
    {
        $reader = $this->getReader();

        $reader->selectSheets([1]);
        $this->assertEquals([1], $reader->settings()->getSheetIndices());
    }

    public function test_ignore_empty()
    {
        $reader = $this->getReader();

        $reader->ignoreEmpty(true);
        $this->assertTrue($reader->settings()->getIgnoreEmpty());

        $reader->ignoreEmpty(false);
        $this->assertFalse($reader->settings()->getIgnoreEmpty());
    }

    public function test_set_date_format()
    {
        $reader = $this->getReader();

        $reader->setDateFormat('d-m-Y');
        $this->assertEquals('d-m-Y', $reader->settings()->getDateFormat());
    }

    public function test_set_date_columns()
    {
        $reader = $this->getReader();

        $reader->setDateColumns(['dob']);
        $this->assertEquals(['dob'], $reader->settings()->getDateColumns());
    }

    public function test_needs_date_formatting()
    {
        $reader = $this->getReader();

        $reader->needsDateFormatting(true);
        $this->assertTrue($reader->settings()->getNeedsDateFormatting());

        $reader->needsDateFormatting(false);
        $this->assertFalse($reader->settings()->getNeedsDateFormatting());
    }

    public function test_set_heading_row()
    {
        $reader = $this->getReader();

        $reader->setHeadingRow(10);
        $this->assertEquals(10, $reader->settings()->getHeadingRow());
    }

    public function test_has_heading()
    {
        $reader = $this->getReader();

        $reader->hasHeading(true);
        $this->assertTrue($reader->settings()->getHasHeading());

        $reader->hasHeading(false);
        $this->assertFalse($reader->settings()->getHasHeading());
    }

    public function test_set_heading_type()
    {
        $reader = $this->getReader();

        $reader->setHeadingType('slugged');
        $this->assertEquals('slugged', $reader->settings()->getHeadingType());
    }

    public function test_set_separator()
    {
        $reader = $this->getReader();

        $reader->setSeparator('-');
        $this->assertEquals('-', $reader->settings()->getSeparator());
    }

    public function test_calculate()
    {
        $reader = $this->getReader();

        $reader->calculate(true);
        $this->assertTrue($reader->settings()->getCalculatedCellValues());

        $reader->calculate(false);
        $this->assertFalse($reader->settings()->getCalculatedCellValues());
    }

    public function test_set_delimiter()
    {
        $reader = new Reader('CSV', __DIR__ . '/files/test.xls');

        $reader->setDelimiter(';');
        $this->assertEquals(';', $reader->getReader()->getDelimiter());
    }

    public function test_set_enclosure()
    {
        $reader = new Reader('CSV', __DIR__ . '/files/test.xls');

        $reader->setEnclosure(';');
        $this->assertEquals(';', $reader->getReader()->getEnclosure());
    }

    /**
     * @return Reader
     */
    protected function getReader()
    {
        $reader = new Reader('Excel5', __DIR__ . '/files/test.xls');

        return $reader;
    }
}
