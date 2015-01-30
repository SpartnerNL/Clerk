<?php namespace Maatwebsite\Clerk\Files;

use Closure;
use League\Csv\Reader;
use Maatwebsite\Clerk\Factories\ReaderFactory;
use Maatwebsite\Clerk\Factories\WorkbookFactory;
use Maatwebsite\Clerk\Factories\WriterFactory;
use Maatwebsite\Clerk\Workbook;

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
     * File extension
     * @var string
     */
    protected $extension;

    /**
     * @param                  $title
     * @param Closure $callback
     * @param bool             $driver
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
     * @param          $filename
     * @param Closure $callback
     * @param bool     $driver
     * @return static
     */
    public static function create($filename, Closure $callback = null, $driver = false)
    {
        return new static($filename, $callback, $driver);
    }

    /**
     * Create new file
     * @param          $file
     * @param Closure $callback
     * @param bool     $driver
     * @param bool     $type
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
     * @return mixed
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