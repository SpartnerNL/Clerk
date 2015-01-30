<?php namespace Maatwebsite\Clerk\Adapters\LeagueCsv;

use Maatwebsite\Clerk\Writer as WriterInterface;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Adapters\Writer as AbstractWriter;

/**
 * Class Writer
 * @package Maatwebsite\Clerk\Adapters\LeagueCsv
 */
class Writer extends AbstractWriter implements WriterInterface {

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