<?php

namespace Maatwebsite\Clerk\Excel\Adapters\LeagueCsv\Writers;

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

        $workbook = $this->getExportable()->getDriver();

        $workbook->output($filename . '.' . $this->getExtension());

        exit;
    }

    /**
     * Get delimiter.
     *
     * @return string
     */
    public function getDelimiter()
    {
        // TODO: Implement getDelimiter() method.
    }

    /**
     * Get enclosure.
     *
     * @return string
     */
    public function getEnclosure()
    {
        // TODO: Implement getEnclosure() method.
    }

    /**
     * Get line ending.
     *
     * @return string
     */
    public function getLineEnding()
    {
        // TODO: Implement getLineEnding() method.
    }
}
