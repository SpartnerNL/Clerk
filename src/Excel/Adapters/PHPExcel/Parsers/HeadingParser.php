<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers;

use Illuminate\Support\Str;
use Maatwebsite\Clerk\Excel\Readers\HeadingParser as AbstractHeadingParser;

/**
 * Class HeadingParser.
 */
class HeadingParser extends AbstractHeadingParser
{
    /**
     * Get the heading.
     *
     * @param \PHPExcel_Worksheet $worksheet
     *
     * @return array
     */
    protected function getHeading($worksheet)
    {
        // Fetch the first row
        $row = $worksheet->getRowIterator($this->settings->getHeadingRow())->current();

        // Set empty labels array
        $heading = [];

        // Loop through the cells
        foreach ($row->getCellIterator() as $cell) {
            $heading[] = $this->getIndex($cell);
        }

        return $heading;
    }

    /**
     * Get orignal indice.
     *
     * @param $cell
     *
     * @return string
     */
    protected function getOriginalIndex($cell)
    {
        return $cell->getValue();
    }
}
