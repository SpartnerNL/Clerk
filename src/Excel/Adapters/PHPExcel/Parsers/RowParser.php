<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers;

use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Cell;
use Maatwebsite\Clerk\Excel\Collections\CellCollection;
use Maatwebsite\Clerk\Excel\Readers\ParserSettings;
use PHPExcel_Cell;
use PHPExcel_Worksheet_Row;

/**
 * Class RowParser.
 */
class RowParser
{
    /**
     * @var ParserSettings
     */
    protected $settings;

    /**
     * @var array
     */
    protected $heading;

    /**
     * @param ParserSettings $settings
     * @param array          $heading
     */
    public function __construct(ParserSettings $settings, array $heading = [])
    {
        $this->settings = $settings;
        $this->heading  = $heading;
    }

    /**
     * @param PHPExcel_Worksheet_Row $row
     *
     * @return CellCollection
     */
    public function parse(PHPExcel_Worksheet_Row $row)
    {
        $iterator = $row->getCellIterator();
        $iterator->setIterateOnlyExistingCells($this->settings->getIgnoreEmpty());

        $cells = [];

        foreach ($iterator as $index => $cell) {
            $index = ($this->settings->getHasHeading() && isset($this->heading[$index])) ? $this->heading[$index] : $this->getIndexFromColumn($cell);

            $cells[$index] = new Cell($cell, $index, $this->settings);
        }

        return new CellCollection($cells);
    }

    /**
     * Get index from column.
     *
     * @param $cell
     *
     * @return mixed
     */
    protected function getIndexFromColumn($cell)
    {
        return PHPExcel_Cell::columnIndexFromString($cell->getColumn());
    }
}
