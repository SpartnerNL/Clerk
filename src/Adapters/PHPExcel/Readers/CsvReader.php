<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Readers;

use Maatwebsite\Clerk\Reader as ReaderInterface;
use Maatwebsite\Clerk\CsvReader as CsvReaderInterface;

class CsvReader extends Reader implements ReaderInterface, CsvReaderInterface {

    /**
     * @var \PHPExcel_Reader_CSV
     */
    protected $reader;

    /**
     * Set CSV delimiter
     * @param $delimiter
     * @return Reader
     */
    public function setDelimiter($delimiter)
    {
        $this->reader->setDelimiter($delimiter);

        return $this;
    }

    /**
     * Set CSV enclosure
     * @param $enclosure
     * @return Reader
     */
    public function setEnclosure($enclosure)
    {
        $this->reader->setEnclosure($enclosure);

        return $this;
    }

    /**
     * Set CSV the line endings
     * @param $lineEnding
     * @return Reader
     */
    public function setLineEnding($lineEnding)
    {
        $this->reader->setLineEnding($lineEnding);

        return $this;
    }
}