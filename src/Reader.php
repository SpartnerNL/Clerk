<?php namespace Maatwebsite\Clerk;

use Closure;
use Maatwebsite\Clerk\Adapters\ParserSettings;

/**
 * Interface Reader
 * @package Maatwebsite\Clerk
 */
interface Reader {

    /**
     * Settings
     * @return ParserSettings
     */
    public function settings();

    /**
     * Get all sheets/rows
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function get($columns = array());

    /**
     * Take x rows
     * @param  integer $amount
     * @return $this
     */
    public function take($amount);

    /**
     * Skip x rows
     * @param  integer $amount
     * @return $this
     */
    public function skip($amount);

    /**
     * Limit the results by x
     * @param  integer $take
     * @param  integer $skip
     * @return $this
     */
    public function limit($take, $skip = 0);

    /**
     * Select certain columns
     * @param  array $columns
     * @return $this
     */
    public function select($columns = array());

    /**
     * Return all sheets/rows
     * @param  array $columns
     * @return $this
     */
    public function all($columns = array());

    /**
     * Get first row/sheet only
     * @param  array $columns
     * @return \Illuminate\Support\Collection
     */
    public function first($columns = array());

    /**
     * Parse the file in chunks
     * @param int $size
     * @param     $callback
     * @throws \Exception
     * @return void
     */
    public function chunk($size = 10, $callback = null);

    /**
     * Each
     * @param  Closure $callback
     * @return \Illuminate\Support\Collection
     */
    public function each(Closure $callback);

    /**
     *  Parse the file to an array.
     * @param  array $columns
     * @return array
     */
    public function toArray($columns = array());

    /**
     * Get the current filename
     * @return string
     */
    public function getFileName();

    /**
     * Select sheets by their indices
     * @param array $sheets
     * @return mixed
     */
    public function selectSheets($sheets = array());

    /**
     * Ignore empty cells
     * @param $value
     * @return mixed
     */
    public function ignoreEmpty($value);

    /**
     * Set the date format
     * @param $format
     * @return mixed
     */
    public function setDateFormat($format);

    /**
     * Set date columns
     * @param array $columns
     * @return mixed
     */
    public function setDateColumns($columns = array());

    /**
     * Workbook needs date formatting
     * @param $state
     * @return mixed
     */
    public function needsDateFormatting($state);

    /**
     * Set the heading row
     * @param $row
     * @return mixed
     */
    public function setHeadingRow($row);

    /**
     * Has heading row
     * @param $state
     * @return mixed
     */
    public function hasHeading($state);

    /**
     * Set the heading type
     * @param $type
     * @return mixed
     */
    public function setHeadingType($type);

    /**
     * Set separator
     * @param $separator
     * @return mixed
     */
    public function setSeparator($separator);

    /**
     * Calculate cell values
     * @param $state
     * @return mixed
     */
    public function calculate($state);

    /**
     * Set CSV delimiter
     * @param $delimiter
     * @return mixed
     */
    public function setDelimiter($delimiter);

    /**
     * Set CSV enclosure
     * @param $enclosure
     * @return mixed
     */
    public function setEnclosure($enclosure);

    /**
     * Set CSV the line endings
     * @param $lineEnding
     * @return mixed
     */
    public function setLineEnding($lineEnding);
}