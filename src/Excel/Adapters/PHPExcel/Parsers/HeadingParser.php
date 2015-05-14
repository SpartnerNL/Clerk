<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers;

use Maatwebsite\Clerk\Excel\Readers\HeadingParser as AbstractHeadingParser;
use PHPExcel_Worksheet;

/**
 * Class HeadingParser.
 */
class HeadingParser extends AbstractHeadingParser
{
    /**
     * @param PHPExcel_Worksheet $sheet
     *
     * @return array
     */
    public function parse(PHPExcel_Worksheet $sheet)
    {
        return $this->settings->getHasHeading() ? $this->getHeading($sheet) : [];
    }

    /**
     * Get the heading.
     *
     * @param PHPExcel_Worksheet $worksheet
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
