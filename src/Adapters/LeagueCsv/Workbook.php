<?php namespace Maatwebsite\Clerk\Adapters\LeagueCsv;

use Closure;
use Maatwebsite\Clerk\Ledger;
use SplTempFileObject;
use League\Csv\Writer as LeagueWriter;
use Maatwebsite\Clerk\Adapters\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Sheet as SheetInterface;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Exceptions\SheetNotFoundException;
use Maatwebsite\Clerk\Exceptions\InvalidArgumentException;

/**
 * Class Workbook
 * @package Maatwebsite\Clerk\Adapters\LeagueCsv
 */
class Workbook extends Adapter implements WorkbookInterface {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var
     */
    protected $title;

    /**
     * @var LeagueWriter
     */
    protected $driver;

    /**
     * Sheet collection
     * @var array
     */
    protected $sheets = array();

    /**
     * @param              $title
     * @param Closure     $callback
     * @param LeagueWriter $driver
     */
    public function __construct($title, Closure $callback = null, LeagueWriter $driver = null)
    {
        // Set PHPExcel instance
        $this->driver = $driver ?: new LeagueWriter(new SplTempFileObject);

        $this->setDefaults();

        // Set workbook title
        $this->setTitle($title);

        // Make a callback on the workbook
        $this->call($callback);
    }

    /**
     * Set reader defaults
     */
    protected function setDefaults()
    {
        $this->setDelimiter(Ledger::get('csv.delimiter'));
        $this->setLineEnding(Ledger::get('csv.line_ending'));
        $this->setEnclosure(Ledger::get('csv.enclosure'));
        $this->setEncoding(Ledger::get('csv.encoding'));
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param $description
     * @return WorkbookInterface
     */
    public function setDescription($description)
    {
        //
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        //
    }

    /**
     * @param $company
     * @return WorkbookInterface
     */
    public function setCompany($company)
    {
        //
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        //
    }

    /**
     * @param $subject
     * @return WorkbookInterface
     */
    public function setSubject($subject)
    {
        //
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        //
    }

    /**
     * Set the delimiter
     * @param $delimiter
     * @return $this
     */
    public function setDelimiter($delimiter)
    {
        $this->getDriver()->setDelimiter($delimiter);

        return $this;
    }

    /**
     * Set line ending
     * @param $lineEnding
     * @return $this
     */
    public function setLineEnding($lineEnding)
    {
        $this->getDriver()->setNewLine($lineEnding);

        return $this;
    }

    /**
     * Set enclosure
     * @param $enclosure
     * @return $this
     */
    public function setEnclosure($enclosure)
    {
        $this->getDriver()->setEnclosure($enclosure);

        return $this;
    }

    /**
     * Set encoding
     * @param $encoding
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->getDriver()->setEncodingFrom($encoding);

        return $this;
    }

    /**
     * Init a new sheet
     * @param          $title
     * @param Closure $callback
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
     * Add a sheet to the sheets collection
     * @param SheetInterface $sheet
     * @return $this
     */
    public function addSheet(SheetInterface $sheet)
    {
        $this->sheets[] = $sheet;

        return $this;
    }

    /**
     * Get the sheet collection
     * @return array
     */
    public function getSheets()
    {
        return $this->sheets;
    }

    /**
     * Get the sheet count
     * @return int
     */
    public function getSheetCount()
    {
        return count($this->sheets);
    }

    /**
     * Check if the sheet exists in the collection
     * @param $index
     * @return bool
     */
    public function sheetExists($index)
    {
        return array_key_exists($index, $this->getSheets());
    }

    /**
     * Check is the given index is valid
     * @param $index
     * @return bool
     */
    public function isValidIndex($index)
    {
        return false !== filter_var($index, FILTER_VALIDATE_INT);
    }

    /**
     * @param $index
     * @return Sheet
     * @throws SheetNotFoundException
     */
    public function getSheetByIndex($index = 0)
    {
        $this->validateSheetIndex($index);

        return $this->sheets[$index];
    }

    /**
     * Remove the sheet by index
     * @param $index
     * @return $this
     */
    public function removeSheetByIndex($index = 0)
    {
        $this->validateSheetIndex($index);

        unset($this->sheets[$index]);

        return $this;
    }

    /**
     * Validate the sheet index
     * @param integer $index
     * @throws InvalidArgumentException
     * @throws SheetNotFoundException
     */
    protected function validateSheetIndex($index)
    {
        // We only accept integers as index
        if ( !$this->isValidIndex($index) )
            throw new InvalidArgumentException("You should provide a valid sheet index");

        // The sheet index should exist inside the collection
        if ( !$this->sheetExists($index) )
            throw new SheetNotFoundException("Sheet with index [{$index}] not found on this workbook");
    }
}