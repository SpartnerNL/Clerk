<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers;

use PHPExcel_Writer_IWriter;
use Maatwebsite\Clerk\Excel\Writer as WriterInterface;

/**
 * Class CsvWriter
 * @package Maatwebsite\Clerk\Adapters\PHPExcel
 */
class CsvWriter extends Writer implements WriterInterface {

    /**
     * @return PHPExcel_Writer_IWriter
     */
    protected function createWriter()
    {
        $writer = new \PHPExcel_Writer_CSV(
            $this->convertToDriver($this->getExportable())
        );

        if ( $this->getType() == 'CSV' )
        {
            $writer->setDelimiter($this->getExportable()->getDelimiter());
            $writer->setEnclosure($this->getExportable()->getEnclosure());
            $writer->setLineEnding($this->getExportable()->getLineEnding());
        }

        return $writer;
    }
}