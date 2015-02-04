<?php namespace Maatwebsite\Clerk\Files;

use Closure;
use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Word\Documents\DocumentFactory;
use Maatwebsite\Clerk\Word\Writers\WriterFactory;

/**
 * Class Excel
 * @package Maatwebsite\Clerk\Files
 */
class Word extends File {

    /**
     * @var string
     */
    protected $extension = 'doc';

    /**
     * @var string
     */
    protected $format = 'Word2007';

    /**
     * @var \Maatwebsite\Clerk\Word\Document
     */
    protected $document;

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
            $this->document = DocumentFactory::create($driver, $title, $callback);
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
     * @param null        $format
     * @return \Maatwebsite\Clerk\Reader
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     */
    public static function load($file, Closure $callback = null, $driver = false, $format = null)
    {
    }

    /**
     * @param $filename
     * @return mixed|void
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
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
            $this->getFormat(),
            $this->getExtension(),
            $this->getDocument()
        );

        return $writer;
    }

    /**
     * @return \Maatwebsite\Clerk\Word\Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Get the driver
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.word2003', 'PHPWord');
    }
}