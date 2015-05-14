<?php

namespace Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser\Parsers;

use Akeneo\Component\SpreadsheetParser\SpreadsheetInterface;
use Maatwebsite\Clerk\Excel\Collections\RowCollection;
use Maatwebsite\Clerk\Excel\Readers\ParserSettings;

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
     * @param SpreadsheetInterface $workbook
     * @param                      $name
     * @param                      $sheetIndex
     *
     * @return RowCollection
     */
    public function parse(SpreadsheetInterface $workbook, $name, $sheetIndex)
    {
        // Init row collection
        $collection = new RowCollection();

        // Set the sheet title
        $collection->setTitle(
            $name
        );

        // Get the sheet heading row
        $heading = (new HeadingParser($this->settings))->parse($workbook, $sheetIndex);

        // Row parser
        $parser = new RowParser($this->settings, $heading);

        foreach ($workbook->createRowIterator($sheetIndex, $this->settings->getRowIteratorSettings()) as $index => $row) {
            if ($index >= $this->getStartRow()) {

                // Limit the results when needed
                if ($this->hasReachedLimit($index)) {
                    break;
                }

                $collection->push(
                    $parser->parse($row)
                );
            }
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
