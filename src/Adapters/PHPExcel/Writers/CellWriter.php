<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Writers;

use Maatwebsite\Clerk\Cell;
use PHPExcel_Worksheet;

class CellWriter {

    /**
     * @var PHPExcel_Worksheet
     */
    protected $sheet;

    /**
     * @param PHPExcel_Worksheet $sheet
     */
    public function __construct(PHPExcel_Worksheet $sheet)
    {
        $this->sheet = $sheet;
    }

    /**
     * @param Cell $cell
     */
    public function write(Cell $cell)
    {
        $this->sheet->setCellValueByColumnAndRow(
            $cell->getCoordinate()->getColumn(),
            $cell->getCoordinate()->getRow(),
            $cell->getValue()
        );

        //$this->sheet->getStyleByColumnAndRow(
        //    $cell->getCoordinate()->getColumn(),
        //    $cell->getCoordinate()->getRow()
        //)->getNumberFormat()->setFormatCode($cell->getDataType());
    }
}