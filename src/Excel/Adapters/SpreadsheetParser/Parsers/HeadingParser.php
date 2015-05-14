<?php

namespace Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser\Parsers;

use Akeneo\Component\SpreadsheetParser\SpreadsheetInterface;
use Illuminate\Support\Str;
use Maatwebsite\Clerk\Excel\Readers\HeadingParser as AbstractHeadingParser;

/**
 * Class HeadingParser.
 */
class HeadingParser extends AbstractHeadingParser
{

    /**
     * @param SpreadsheetInterface                     $workbook
     * @param                                          $sheetIndex
     *
     * @return array
     */
    public function parse(SpreadsheetInterface $workbook, $sheetIndex)
    {
        return $this->settings->getHasHeading() ? $this->getHeading($workbook, $sheetIndex) : [];
    }

    /**
     * Get the heading.
     *
     * @param SpreadsheetInterface $workbook
     * @param                      $sheetIndex
     *
     * @return array
     */
    protected function getHeading(SpreadsheetInterface $workbook, $sheetIndex)
    {
        // Fetch the first row
        $row = $workbook->createRowIterator($sheetIndex, $this->settings->getRowIteratorSettings());

        // Set empty labels array
        $heading = [];

        // Loop through the cells
        foreach ($row as $index => $values) {

            if ($index == $this->settings->getHeadingRow()) {
                foreach ($values as $cell) {
                    $heading[] = $this->getIndex($cell);
                }

                return $heading;
            }
        }

        return $heading;
    }

    /**
     * Get original index.
     *
     * @param $cell
     *
     * @return string
     */
    protected function getOriginalIndex($cell)
    {
        return $cell;
    }
}
