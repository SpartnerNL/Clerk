<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers;

use Maatwebsite\Clerk\Excel\Collections\RowCollection;
use Maatwebsite\Clerk\Excel\Readers\ParserSettings;
use PHPExcel_Worksheet;

/**
 * Class SheetParser.
 */
class SheetParser
{
    /**
     * @var ParserSettings
     */
    protected $settings;

    /**
     * @param ParserSettings $settings
     */
    public function __construct(ParserSettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param PHPExcel_Worksheet $sheet
     *
     * @return RowCollection
     */
    public function parse(PHPExcel_Worksheet $sheet)
    {
        // Init row collection
        $collection = new RowCollection();

        // Set the sheet title
        $collection->setTitle(
            $sheet->getTitle()
        );

        // Get the sheet heading row
        $heading = (new HeadingParser($this->settings))->parse($sheet);

        // Row parsers
        $parser = new RowParser($this->settings, $heading);

        foreach ($sheet->getRowIterator($this->getStartRow()) as $index => $row) {
            // Limit the results when needed
            if ($this->hasReachedLimit($index)) {
                break;
            }

            $collection->push(
                $parser->parse($row)
            );
        }

        return $collection;
    }

    /**
     * Get the start row.
     *
     * @return mixed
     */
    protected function getStartRow()
    {
        $startRow = $this->settings->getStartRow();

        // If the reader has a heading, skip the first row
        if ($this->settings->getHasHeading()) {
            $startRow = $this->settings->getHeadingRow();
            $startRow++;
        }

        // Get the amount of rows to skip
        $skip = $this->settings->getSkipAmount();

        // If we want to skip rows, add the amount of rows
        if ($skip > 0) {
            $startRow = $startRow + $skip;
        }

        return $startRow;
    }

    /**
     * Check if we didn't read the limit yet.
     *
     * @param $index
     *
     * @return bool
     */
    protected function hasReachedLimit($index)
    {
        return $this->settings->getMaxRows() && $index > $this->settings->getMaxRows() ? true : false;
    }
}
