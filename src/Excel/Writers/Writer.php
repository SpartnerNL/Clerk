<?php namespace Maatwebsite\Clerk\Excel\Writers;

use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;

/**
 * Class Writer
 * @package Maatwebsite\Clerk\Adapters
 */
abstract class Writer {

    /**
     * @var WorkbookInterface
     */
    protected $workbook;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param                   $type
     * @param                   $extension
     * @param WorkbookInterface $workbook
     */
    public function __construct($type, $extension, WorkbookInterface $workbook)
    {
        $this->extension = $extension;
        $this->type = $type;
        $this->workbook = $workbook;
    }

    /**
     * @param null $filename
     * @return mixed
     */
    abstract public function export($filename = null);

    /**
     * @return WorkbookInterface
     */
    public function getWorkbook()
    {
        return $this->workbook;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->getWorkbook()->getTitle();
    }

    /**
     * @param string|null $filename
     * @return string
     */
    protected function getFilename($filename = null)
    {
        if ( !$filename )
            return $this->getTitle();

        // Strip of file extensions
        if ( strpos($filename, '.') !== false )
        {
            return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        }

        return $filename;
    }

    /**
     * @param $headers
     * @throws \Exception
     */
    protected function sendHeaders($headers)
    {
        if ( headers_sent() ) throw new \Exception('Headers already sent');

        foreach ($headers as $header => $value)
        {
            header($header . ': ' . $value);
        }
    }
}