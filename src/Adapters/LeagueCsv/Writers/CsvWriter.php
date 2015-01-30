<?php namespace Maatwebsite\Clerk\Adapters\LeagueCsv\Writers;

use Maatwebsite\Clerk\Writer as WriterInterface;
use Maatwebsite\Clerk\Adapters\Writer as AbstractWriter;

/**
 * Class Writer
 * @package Maatwebsite\Clerk\Adapters\LeagueCsv
 */
class CsvWriter extends AbstractWriter implements WriterInterface {

    /**
     * @param null $filename
     * @return mixed
     * @throws \Exception
     */
    public function export($filename = null)
    {
        $filename = $this->getFilename($filename);

        $workbook = $this->workbook->getDriver();

        $workbook->output($filename . '.' . $this->getExtension());

        exit;
    }
}