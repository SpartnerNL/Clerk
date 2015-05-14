<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Readers;

use Closure;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers\WorkbookParser;
use Maatwebsite\Clerk\Excel\Readers\Reader as AbstractReader;
use PHPExcel;
use PHPExcel_IOFactory;

/**
 * Class Reader.
 */
class Reader extends AbstractReader
{
    /**
     * @var \PHPExcel_Reader_IReader
     */
    protected $reader;

    /**
     * @param string  $type
     * @param string  $file
     * @param Closure $callback
     */
    public function __construct($type, $file, Closure $callback = null)
    {
        $this->setWriter($type);
        $this->file = $file;

        $this->call($callback);
    }

    /**
     * Set the writer.
     *
     * @param $type
     */
    protected function setWriter($type)
    {
        $this->reader = PHPExcel_IOFactory::createReader($type);
    }

    /**
     * Get all sheets/rows.
     *
     * @param array $columns
     *
     * @return \Illuminate\Support\Collection
     */
    public function get($columns = [])
    {
        // Load the file
        $this->driver = $this->reader->load($this->file);

        // Set selected columns
        $this->settings()->setColumns($columns);

        return (new WorkbookParser($this->settings()))->parse($this->getWorkbook());
    }

    /**
     * @return \PHPExcel_Reader_IReader
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @return PHPExcel
     */
    protected function getWorkbook()
    {
        return $this->getDriver();
    }
}
