<?php

namespace Maatwebsite\Clerk\Excel\Adapters\LeagueCsv;

use Closure;
use League\Csv\Writer as LeagueWriter;
use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Excel\Workbooks\Workbook as AbstractWorkbook;
use SplTempFileObject;

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
     * @var LeagueWriter
     */
    protected $driver;

    /**
     * @param              $title
     * @param Closure      $callback
     * @param LeagueWriter $driver
     */
    public function __construct($title, Closure $callback = null, LeagueWriter $driver = null)
    {
        // Set driver instance
        $this->driver = $driver ?: LeagueWriter::createFromFileObject(new SplTempFileObject());

        parent::__construct($title, $callback);
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
     * @throws FeaturedNotSupportedException
     */
    public function setDescription($description)
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * @throws FeaturedNotSupportedException
     */
    public function getDescription()
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * @param $company
     *
     * @throws FeaturedNotSupportedException
     * @return $this|void
     */
    public function setCompany($company)
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * @throws FeaturedNotSupportedException
     */
    public function getCompany()
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * @param $subject
     *
     * @throws FeaturedNotSupportedException
     * @return WorkbookInterface
     */
    public function setSubject($subject)
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * @throws FeaturedNotSupportedException
     * @return string
     */
    public function getSubject()
    {
        throw new FeaturedNotSupportedException();
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
        $this->getDriver()->setDelimiter($delimiter);

        return $this;
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
        $this->getDriver()->setNewLine($lineEnding);

        return $this;
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
        $this->getDriver()->setEnclosure($enclosure);

        return $this;
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
        $this->getDriver()->setEncodingFrom($encoding);

        return $this;
    }

    /**
     * Init a new sheet.
     *
     * @param         $title
     * @param Closure $callback
     *
     * @return Sheet
     */
    public function sheet($title, Closure $callback = null)
    {
        // Init a new sheet
        $sheet = new Sheet(
            $this,
            $title,
            null,
            $this->driver
        );

        // Preform callback on the sheet
        $sheet->call($callback);

        // Add the sheet to the collection
        $this->addSheet($sheet);

        return $sheet;
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
