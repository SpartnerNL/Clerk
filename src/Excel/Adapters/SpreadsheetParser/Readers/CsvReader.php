<?php

namespace Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser\Readers;

use Maatwebsite\Clerk\Excel\CsvReader as CsvReaderInterface;
use Maatwebsite\Clerk\Excel\Reader as ReaderInterface;

/**
 * Class CsvReader.
 */
class CsvReader extends Reader implements ReaderInterface, CsvReaderInterface
{
    /**
     * Set CSV delimiter.
     *
     * @param $delimiter
     *
     * @return Reader
     */
    public function setDelimiter($delimiter)
    {
        $this->settings()->setRowIteratorSetting('delimiter', $delimiter);

        return $this;
    }

    /**
     * Set CSV enclosure.
     *
     * @param $enclosure
     *
     * @return Reader
     */
    public function setEnclosure($enclosure)
    {
        $this->settings()->setRowIteratorSetting('enclosure', $enclosure);

        return $this;
    }

    /**
     * Set CSV the line endings.
     *
     * @param $lineEnding
     *
     * @return Reader
     */
    public function setLineEnding($lineEnding)
    {
        $this->settings()->setRowIteratorSetting('escape', $lineEnding);

        return $this;
    }
}
