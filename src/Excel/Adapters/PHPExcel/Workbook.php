<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel;

use Closure;
use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Excel\Workbooks\Workbook as AbstractWorkbook;
use PHPExcel;

/**
 * Class Workbook.
 */
class Workbook extends AbstractWorkbook implements WorkbookInterface
{
    /*
     * @var PHPExcel
     */
    protected $driver;

    /**
     * @var string
     */
    protected $lineEnding;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @var string
     */
    protected $enclosure;

    /**
     * @var string
     */
    protected $encoding;

    /**
     * @param          $title
     * @param Closure  $callback
     * @param PHPExcel $driver
     */
    public function __construct($title, Closure $callback = null, PHPExcel $driver = null)
    {
        // Set PHPExcel instance
        $this->driver = $driver ?: new PHPExcel();
        $this->driver->disconnectWorksheets();

        parent::__construct($title, $callback);
    }

    /**
     * Get the workbook title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->driver->getProperties()->getTitle();
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
        $this->driver->getProperties()->setTitle($title);

        return $this;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->driver->getProperties()->setDescription($description);

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->driver->getProperties()->getDescription();
    }

    /**
     * @param $company
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->driver->getProperties()->setCompany($company);

        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->driver->getProperties()->getCompany();
    }

    /**
     * @param $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->driver->getProperties()->setSubject($subject);

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->driver->getProperties()->getSubject();
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
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * Get the delimiter.
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
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
        $this->lineEnding = $lineEnding;

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
        $this->enclosure = $enclosure;

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
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * @return string
     */
    public function getLineEnding()
    {
        return $this->lineEnding;
    }

    /**
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
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
            $title
        );

        // Preform callback on the sheet
        $sheet->call($callback);

        // Add the sheet to the collection
        $this->addSheet($sheet);

        return $sheet;
    }
}
