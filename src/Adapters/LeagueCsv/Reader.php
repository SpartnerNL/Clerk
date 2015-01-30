<?php namespace Maatwebsite\Clerk\Adapters\LeagueCsv;

use Closure;
use Maatwebsite\Clerk\LaravelExcelReader;
use Maatwebsite\Clerk\Adapters\Adapter;
use Maatwebsite\Clerk\Adapters\ParserSettings;
use Maatwebsite\Clerk\Reader as ReaderInterface;

/**
 * Class Reader
 * @package Maatwebsite\Clerk\Adapters\LeagueCsv
 */
class Reader extends Adapter implements ReaderInterface {


    /**
     * Settings
     * @return ParserSettings
     */
    public function settings()
    {
        // TODO: Implement settings() method.
    }

    /**
     * Get all sheets/rows
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function get($columns = array())
    {
        // TODO: Implement get() method.
    }

    /**
     * Take x rows
     * @param  integer $amount
     * @return LaravelExcelReader
     */
    public function take($amount)
    {
        // TODO: Implement take() method.
    }

    /**
     * Skip x rows
     * @param  integer $amount
     * @return LaravelExcelReader
     */
    public function skip($amount)
    {
        // TODO: Implement skip() method.
    }

    /**
     * Limit the results by x
     * @param  integer $take
     * @param  integer $skip
     * @return LaravelExcelReader
     */
    public function limit($take, $skip = 0)
    {
        // TODO: Implement limit() method.
    }

    /**
     * Select certain columns
     * @param  array $columns
     * @return LaravelExcelReader
     */
    public function select($columns = array())
    {
        // TODO: Implement select() method.
    }

    /**
     * Return all sheets/rows
     * @param  array $columns
     * @return LaravelExcelReader
     */
    public function all($columns = array())
    {
        // TODO: Implement all() method.
    }

    /**
     * Get first row/sheet only
     * @param  array $columns
     * @return \Illuminate\Support\Collection
     */
    public function first($columns = array())
    {
        // TODO: Implement first() method.
    }

    /**
     * Parse the file in chunks
     * @param int $size
     * @param     $callback
     * @throws \Exception
     * @return void
     */
    public function chunk($size = 10, $callback = null)
    {
        // TODO: Implement chunk() method.
    }

    /**
     * Each
     * @param  Closure $callback
     * @return \Illuminate\Support\Collection
     */
    public function each(Closure $callback)
    {
        // TODO: Implement each() method.
    }

    /**
     *  Parse the file to an array.
     * @param  array $columns
     * @return array
     */
    public function toArray($columns = array())
    {
        // TODO: Implement toArray() method.
    }

    /**
     * Get the current filename
     * @return string
     */
    public function getFileName()
    {
        // TODO: Implement getFileName() method.
    }

    /**
     * Select sheets by their indices
     * @param array $sheets
     * @return mixed
     */
    public function selectSheets($sheets = array())
    {
        // TODO: Implement selectSheets() method.
    }

    /**
     * Ignore empty cells
     * @param $value
     * @return mixed
     */
    public function ignoreEmpty($value)
    {
        // TODO: Implement ignoreEmpty() method.
    }

    /**
     * Set the date format
     * @param $format
     * @return mixed
     */
    public function setDateFormat($format)
    {
        // TODO: Implement setDateFormat() method.
    }

    /**
     * Set date columns
     * @param array $columns
     * @return mixed
     */
    public function setDateColumns($columns = array())
    {
        // TODO: Implement setDateColumns() method.
    }

    /**
     * Workbook needs date formatting
     * @param $state
     * @return mixed
     */
    public function needsDateFormatting($state)
    {
        // TODO: Implement needsDateFormatting() method.
    }

    /**
     * Set the heading row
     * @param $row
     * @return mixed
     */
    public function setHeadingRow($row)
    {
        // TODO: Implement setHeadingRow() method.
    }

    /**
     * Has heading row
     * @param $state
     * @return mixed
     */
    public function hasHeading($state)
    {
        // TODO: Implement hasHeading() method.
    }

    /**
     * Set the heading type
     * @param $type
     * @return mixed
     */
    public function setHeadingType($type)
    {
        // TODO: Implement setHeadingType() method.
    }

    /**
     * Set separator
     * @param $separator
     * @return mixed
     */
    public function setSeparator($separator)
    {
        // TODO: Implement setSeparator() method.
    }

    /**
     * Calculate cell values
     * @param $state
     * @return mixed
     */
    public function calculate($state)
    {
        // TODO: Implement calculate() method.
    }

    /**
     * Set CSV delimiter
     * @param $delimiter
     * @return mixed
     */
    public function setDelimiter($delimiter)
    {
        // TODO: Implement setDelimiter() method.
    }

    /**
     * Set CSV enclosure
     * @param $enclosure
     * @return mixed
     */
    public function setEnclosure($enclosure)
    {
        // TODO: Implement setEnclosure() method.
    }

    /**
     * Set CSV the line endings
     * @param $lineEnding
     * @return mixed
     */
    public function setLineEnding($lineEnding)
    {
        // TODO: Implement setLineEnding() method.
    }
}