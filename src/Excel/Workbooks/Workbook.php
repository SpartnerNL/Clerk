<?php namespace Maatwebsite\Clerk\Excel\Workbooks;

use Closure;
use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Excel\Styles\Styleable;
use Maatwebsite\Clerk\Excel\Traits\StyleableTrait;
use Maatwebsite\Clerk\Excel\Sheet as SheetInterface;
use Maatwebsite\Clerk\Exceptions\SheetNotFoundException;
use Maatwebsite\Clerk\Exceptions\InvalidArgumentException;

/**
 * Class Workbook
 * @package Maatwebsite\Clerk\Adapters
 */
abstract class Workbook extends Adapter implements Styleable {

    /**
     * Traits
     */
    use CallableTrait, StyleableTrait;

    /**
     * Sheet collection
     * @var array
     */
    protected $sheets = array();

    /**
     * @param          $title
     * @param Closure  $callback
     */
    public function __construct($title, Closure $callback = null)
    {
        // Set defaults
        $this->setDefaults();

        // Set workbook title
        $this->setTitle($title);

        // Make a callback on the workbook
        $this->call($callback);
    }

    /**
     * Set title
     * @param string $title
     * @return $this
     */
    public abstract function setTitle($title);

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
     * Get delimiter
     * @return string
     */
    abstract public function getDelimiter();

    /**
     * Get enclosure
     * @return string
     */
    abstract public function getEnclosure();

    /**
     * Get line ending
     * @return string
     */
    abstract public function getLineEnding();

    /**
     * Set delimiter
     * @return mixed
     */
    abstract public function setDelimiter($delimiter);

    /**
     * Set line ending
     * @param $lineEnding
     * @return mixed
     */
    abstract public function setLineEnding($lineEnding);

    /**
     * Set enclosure
     * @param $enclosure
     * @return mixed
     */
    abstract public function setEnclosure($enclosure);

    /**
     * Set encoding
     * @param $encoding
     * @return mixed
     */
    abstract public function setEncoding($encoding);

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
     * @param integer $index
     * @return bool
     */
    public function sheetExists($index)
    {
        return array_key_exists($index, $this->getSheets());
    }

    /**
     * Check is the given index is valid
     * @param integer $index
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