<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Writers;

use Carbon\Carbon;
use Maatwebsite\Clerk\Adapters\Writer as AbstractWriter;
use Maatwebsite\Clerk\Writer as WriterInterface;
use PHPExcel_IOFactory;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;
use PHPExcel_Writer_IWriter;

/**
 * Class Writer
 * @package Maatwebsite\Clerk\Adapters\PHPExcel
 */
class CsvWriter extends Writer implements WriterInterface {

    /**
     * @return PHPExcel_Writer_IWriter
     */
    protected function createWriter()
    {
        $writer = new \PHPExcel_Writer_CSV(
            $this->convertToDriver($this->getWorkbook())
        );

        if ( $this->getType() == 'CSV' )
        {
            $writer->setDelimiter($this->workbook->getDelimiter());
            $writer->setEnclosure($this->workbook->getEnclosure());
            $writer->setLineEnding($this->workbook->getLineEnding());
        }

        return $writer;
    }
}