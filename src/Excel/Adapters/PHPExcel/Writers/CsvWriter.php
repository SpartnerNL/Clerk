<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers;

use Maatwebsite\Clerk\Excel\Writer as WriterInterface;
use PHPExcel_Writer_IWriter;

/**
 * Class CsvWriter.
 */
class CsvWriter extends Writer implements WriterInterface
{
    /**
     * @return PHPExcel_Writer_IWriter
     */
    protected function createWriter()
    {
        $writer = new \PHPExcel_Writer_CSV(
            $this->convertToDriver($this->getExportable())
        );

        if ($this->getType() == 'CSV') {
            $writer->setDelimiter($this->getExportable()->getDelimiter());
            $writer->setEnclosure($this->getExportable()->getEnclosure());
            $writer->setLineEnding($this->getExportable()->getLineEnding());
        }

        return $writer;
    }
}
