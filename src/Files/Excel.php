<?php

namespace Maatwebsite\Clerk\Files;

use Closure;
use Maatwebsite\Clerk\Excel\Readers\ReaderFactory;
use Maatwebsite\Clerk\Excel\Workbook;
use Maatwebsite\Clerk\Excel\Workbooks\WorkbookFactory;
use Maatwebsite\Clerk\Excel\Writers\WriterFactory;
use Maatwebsite\Clerk\Ledger;

/**
 * Class Excel.
 */
class Excel extends File
{
    /**
     * @var Workbook
     */
    protected $workbook;

    /**
     * @var string
     */
    protected $extension = 'xls';

    /**
     * @var string
     */
    protected $format = 'Excel5';

    /**
     * @param string  $title
     * @param Closure $callback
     */
    public function __construct($title = null, Closure $callback = null)
    {
        $this->workbook = WorkbookFactory::create($this->getDriver('writer'), $title, $callback);
    }

    /**
     * Create new file.
     *
     * @param string  $filename
     * @param Closure $callback
     *
     * @return static
     */
    public static function create($filename, Closure $callback = null)
    {
        return new static($filename, $callback);
    }

    /**
     * Create new file.
     *
     * @param string  $file
     * @param Closure $callback
     * @param null    $format
     *
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     * @return \Maatwebsite\Clerk\Excel\Reader
     */
    public static function load($file, Closure $callback = null, $format = null)
    {
        // Passing in empty strings, will prevent a workbook from being initialized
        $instance = new static();
        $format   = $format ?: $instance->getFormat();

        return ReaderFactory::create(
            $instance->getDriver('reader'),
            $file,
            $callback,
            $format
        );
    }

    /**
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     * @return \Maatwebsite\Clerk\Writer
     */
    public function initWriter()
    {
        $writer = WriterFactory::create(
            $this->getDriver('writer'),
            $this->getFormat(),
            $this->getExtension(),
            $this->getWorkbook()
        );

        return $writer;
    }

    /**
     * Get the driver.
     *
     * @param $type
     *
     * @return mixed
     */
    protected function getDriver($type)
    {
        return Ledger::get('drivers.' . $type . '.excel2003', 'PHPExcel');
    }
}
