<?php namespace Maatwebsite\Clerk\Files;

use Closure;
use Maatwebsite\Clerk\Excel\Workbook;
use Maatwebsite\Clerk\Excel\Readers\ReaderFactory;
use Maatwebsite\Clerk\Excel\Writers\WriterFactory;
use Maatwebsite\Clerk\Excel\Workbooks\WorkbookFactory;

/**
 * Class File
 * @package Maatwebsite\Clerk\Files
 */
abstract class File {

    /**
     * @var Workbook
     */
    protected $workbook;

    /**
     * @var string
     */
    protected $type;

    /**
     * File extension
     * @var string
     */
    protected $extension;

    /**
     * @param string      $title
     * @param Closure     $callback
     * @param bool|string $driver
     */
    public function __construct($title, Closure $callback = null, $driver = false)
    {
        // Get the driver
        $driver = $driver ?: $this->getDriver();

        if ( $driver )
        {
            $this->workbook = WorkbookFactory::create($driver, $title, $callback);
        }
    }

    /**
     * Create new file
     * @param string      $filename
     * @param Closure     $callback
     * @param bool|string $driver
     * @return static
     */
    public static function create($filename, Closure $callback = null, $driver = false)
    {
        return new static($filename, $callback, $driver);
    }

    /**
     * Create new file
     * @param string      $file
     * @param Closure     $callback
     * @param bool|string $driver
     * @param bool|string $type
     * @return \Maatwebsite\Clerk\Reader
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     */
    public static function load($file, Closure $callback = null, $driver = false, $type = false)
    {
        // Passing in empty strings, will prevent a workbook from being initialized
        $instance = (new static('', null, ''));
        $driver = $driver ?: $instance->getDriver();
        $type = $type ?: $instance->getType();

        return ReaderFactory::create(
            $driver,
            $file,
            $callback,
            $type
        );
    }

    /**
     * @param $filename
     * @return mixed|void
     * @throws \Maatwebsite\Clerk\Factories\DriverNotFoundException
     */
    public function export($filename = null)
    {
        $writer = $this->initWriter();

        return $writer->export($filename);
    }

    /**
     * @return \Maatwebsite\Clerk\Writer
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     */
    protected function initWriter()
    {
        $writer = WriterFactory::create(
            $this->getDriver(),
            $this->getType(),
            $this->getExtension(),
            $this->getWorkbook()
        );

        return $writer;
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return Workbook
     */
    public function getWorkbook()
    {
        return $this->workbook;
    }

    /**
     * @return mixed
     */
    abstract protected function getDriver();
}