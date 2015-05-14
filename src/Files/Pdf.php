<?php

namespace Maatwebsite\Clerk\Files;

use Closure;
use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Pdf\Documents\DocumentFactory;
use Maatwebsite\Clerk\Pdf\Writers\WriterFactory;

class Pdf extends File
{
    /**
     * @var string
     */
    protected $extension = 'pdf';

    /**
     * @var string
     */
    protected $format = 'Pdf';

    /**
     * @var \Maatwebsite\Clerk\Pdf\Document
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

        if ($driver) {
            $this->document = DocumentFactory::create($driver, $title, $callback);
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
     * @return \Maatwebsite\Clerk\Reader
     */
    public static function load($file, Closure $callback = null, $driver = false, $format = null)
    {
    }

    /**
     * @param $filename
     *
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     * @return mixed|void
     */
    public function stream($filename = null)
    {
        $writer = $this->initWriter();

        return $writer->stream($filename);
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
            $this->getDocument()
        );

        return $writer;
    }

    /**
     * @return \Maatwebsite\Clerk\Pdf\Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Get the driver.
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.pdf', 'Snappy');
    }
}
