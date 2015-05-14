<?php

namespace Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser;

use Closure;
use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Excel\Workbooks\Workbook as AbstractWorkbook;
use Maatwebsite\Clerk\Exceptions\FeatureNotSupportedException;

/**
 * Class Workbook.
 */
class Workbook extends AbstractWorkbook implements WorkbookInterface
{
    /**
     * @var
     */
    protected $title;

    /**
     * Set reader defaults.
     */
    protected function setDefaults()
    {

    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param $description
     *
     * @throws FeatureNotSupportedException
     * @return $this|void
     */
    public function setDescription($description)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * @throws FeatureNotSupportedException
     */
    public function getDescription()
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * @param $company
     *
     * @throws FeatureNotSupportedException
     * @return $this|void
     */
    public function setCompany($company)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * @throws FeatureNotSupportedException
     */
    public function getCompany()
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * @param $subject
     *
     * @throws FeatureNotSupportedException
     * @return WorkbookInterface
     */
    public function setSubject($subject)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * @throws FeatureNotSupportedException
     * @return string
     */
    public function getSubject()
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * Set the delimiter.
     *
     * @param $delimiter
     *
     * @return $this
     */
    public function setDelimiter($delimiter)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * Set line ending.
     *
     * @param $lineEnding
     *
     * @return $this
     */
    public function setLineEnding($lineEnding)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * Set enclosure.
     *
     * @param $enclosure
     *
     * @return $this
     */
    public function setEnclosure($enclosure)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * Set encoding.
     *
     * @param $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * Init a new sheet.
     *
     * @param         $title
     * @param Closure $callback
     *
     * @throws FeatureNotSupportedException
     * @return Sheet
     */
    public function sheet($title, Closure $callback = null)
    {
        throw new FeatureNotSupportedException();
    }

    /**
     * Get delimiter.
     * @return string
     */
    public function getDelimiter()
    {
        return $this->getDriver()->getDelimiter();
    }

    /**
     * Get enclosure.
     * @return string
     */
    public function getEnclosure()
    {
        return $this->getDriver()->getEnclosure();
    }

    /**
     * Get line ending.
     * @return string
     */
    public function getLineEnding()
    {
        return $this->getDriver()->getLineEnding();
    }
}
