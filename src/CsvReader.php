<?php namespace Maatwebsite\Clerk;

interface CsvReader {

    /**
     * Set CSV delimiter
     * @param $delimiter
     * @return Reader
     */
    public function setDelimiter($delimiter);

    /**
     * Set CSV enclosure
     * @param $enclosure
     * @return Reader
     */
    public function setEnclosure($enclosure);

    /**
     * Set CSV the line endings
     * @param $lineEnding
     * @return Reader
     */
    public function setLineEnding($lineEnding);
}