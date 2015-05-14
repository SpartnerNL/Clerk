<?php

namespace Maatwebsite\Clerk\Files;

use Closure;
use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Word\Documents\DocumentFactory;
use Maatwebsite\Clerk\Word\Writers\WriterFactory;

/**
 * Class Excel.
 */
class Word extends File
{
    /**
     * @var string
     */
    protected $extension = 'doc';

    /**
     * @var string
     */
    protected $format = 'Word';

    /**
     * @var \Maatwebsite\Clerk\Word\Document
     */
    protected $document;

    /**
     * @param string      $title
     * @param Closure     $callback
     */
    public function __construct($title, Closure $callback = null)
    {
        $this->document = DocumentFactory::create($this->getDriver('writer'), $title, $callback);

    }

    /**
     * Create new file.
     *
     * @param string      $filename
     * @param Closure     $callback
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
     * @param string      $file
     * @param Closure     $callback
     * @param null        $format
     *
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     * @return \Maatwebsite\Clerk\Reader
     */
    public static function load($file, Closure $callback = null, $format = null)
    {
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
     * Get the driver.
     *
     * @param $type
     *
     * @return mixed
     */
    protected function getDriver($type)
    {
        return Ledger::get('drivers.'. $type .'.word2003', 'PHPWord');
    }
}
