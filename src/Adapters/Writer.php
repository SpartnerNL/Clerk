<?php namespace Maatwebsite\Clerk\Adapters;

use Maatwebsite\Clerk\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Adapters\PHPExcel\Identifiers\FormatIdentifier;

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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getWorkbook()->getTitle();
    }

    /**
     * @param $filename
     * @return mixed
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
     * @param $format
     * @return string
     */
    public function getContentType($format)
    {
        return (new FormatIdentifier())->getContentTypeByFormat($format);
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