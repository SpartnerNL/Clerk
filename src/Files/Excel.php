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
     * @param string      $title
     * @param Closure     $callback
     * @param bool|string $driver
     */
    public function __construct($title = null, Closure $callback = null, $driver = false)
    {
        // Get the driver
        $driver = $driver ?: $this->getDriver();

        if ($driver) {
            $this->workbook = WorkbookFactory::create($driver, $title, $callback);
        }
    }

    /**
     * Create new file.
     *
     * @param string      $filename
     * @param Closure     $callback
     * @param bool|string $driver
     *
     * @return static
     */
    public static function create($filename, Closure $callback = null, $driver = false)
    {
        return new static($filename, $callback, $driver);
    }

    /**
     * Create new file.
     *
     * @param string      $file
     * @param Closure     $callback
     * @param bool|string $driver
     * @param null        $format
     *
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     * @return \Maatwebsite\Clerk\Excel\Reader
     */
    public static function load($file, Closure $callback = null, $driver = false, $format = null)
    {
        // Passing in empty strings, will prevent a workbook from being initialized
        $instance = new static();
        $driver = $driver ?: $instance->getDriver();
        $format = $format ?: $instance->getFormat();

        return ReaderFactory::create(
            $driver,
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
            $this->getDriver(),
            $this->getFormat(),
            $this->getExtension(),
            $this->getWorkbook()
        );

        return $writer;
    }

    /**
     * Get the driver.
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.excel2003', 'PHPExcel');
    }
}
