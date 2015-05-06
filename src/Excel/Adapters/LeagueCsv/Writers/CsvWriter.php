<?php

namespace Maatwebsite\Clerk\Excel\Adapters\LeagueCsv\Writers;

use Maatwebsite\Clerk\Excel\Workbook;
use Maatwebsite\Clerk\Excel\Writer as WriterInterface;
use Maatwebsite\Clerk\Writers\Writer as AbstractWriter;

/**
 * Class CsvWriter.
 */
class CsvWriter extends AbstractWriter implements WriterInterface
{
    /**
     * @param null $filename
     *
     * @throws \Exception
     * @return mixed
     */
    public function export($filename = null)
    {
        $filename = $this->getFilename($filename);

        $source = $this->convertCellsToArray($this->getExportable());

        $workbook = $this->getExportable()->getDriver()->insertAll($source);

        $workbook->output($filename . '.' . $this->getExtension());

        exit;
    }

    /**
     * @param      $path
     * @param null $filename
     *
     * @return mixed
     */
    public function store($path, $filename = null)
    {
        // TODO: Implement store() method.
    }

    /**
     * Convert cells to array
     * @param Workbook $workbook
     *
     * @return array
     */
    protected function convertCellsToArray(Workbook $workbook)
    {
        $source = [];
        $r      = 0;
        $row    = 1;
        foreach ($workbook->getSheets() as $sheet) {
            foreach ($sheet->getCells() as $cell) {

                // Go to next row when needed
                if ($cell->getCoordinate()->getRow() != $row) {
                    $r++;
                }

                // Set value
                $source[$r][] = $cell->getValue();

                // Save last row
                $row = $cell->getCoordinate()->getRow();
            }
        }

        return $source;
    }
}
