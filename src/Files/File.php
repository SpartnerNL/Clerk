<?php namespace Maatwebsite\Clerk\Files;

/**
 * Class File
 * @package Maatwebsite\Clerk\Files
 */
abstract class File {

    /**
     * @var string
     */
    protected $format;

    /**
     * File extension
     * @var string
     */
    protected $extension;

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return \Maatwebsite\Clerk\Excel\Workbook
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