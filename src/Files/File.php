<?php

namespace Maatwebsite\Clerk\Files;

/**
 * Class File.
 */
abstract class File
{
    /**
     * @var string
     */
    protected $format;

    /**
     * File extension.
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
     * @param $filename
     *
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     * @return mixed|void
     */
    public function export($filename = null)
    {
        $writer = $this->initWriter();

        return $writer->export($filename);
    }

    /**
     * @param      $path
     * @param null $filename
     *
     * @return mixed|void
     */
    public function store($path, $filename = null)
    {
        $writer = $this->initWriter();

        return $writer->store($path, $filename = null);
    }

    /**
     * @throws \Maatwebsite\Clerk\Exceptions\DriverNotFoundException
     * @return \Maatwebsite\Clerk\Writer
     */
    abstract public function initWriter();

    /**
     * @return mixed
     */
    abstract protected function getDriver();
}
