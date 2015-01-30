<?php namespace Maatwebsite\Clerk\Adapters;

use Maatwebsite\Clerk\Adapters\PHPExcel\Identifiers\FormatIdentifier;

/**
 * Class Writer
 * @package Maatwebsite\Clerk\Adapters
 */
abstract class Writer {

    /**
     * @param null $filename
     * @return mixed
     */
    abstract public function export($filename = null);

    /**
     * @param $filename
     * @return mixed
     */
    protected function getFilename($filename = null)
    {
        if ( !$filename )
            return $this->workbook->getTitle();

        // Strip of file extensions
        if ( strpos($filename, '.') !== false )
        {
            return $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
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