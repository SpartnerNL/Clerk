<?php namespace Maatwebsite\Clerk\Adapters;

/**
 * Class ParserSettings
 * @package Maatwebsite\Clerk\Adapters
 */
class ParserSettings {

    /**
     * @var array
     */
    protected $sheetIndices = [];

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @var int
     */
    protected $startRow = 1;

    /**
     * @var bool|int
     */
    protected $maxRows = false;

    /**
     * @var bool
     */
    protected $ignoreEmpty = true;

    /**
     * @var bool|string
     */
    protected $dateFormat = false;

    /**
     * @var array
     */
    protected $dateColumns = array();

    /**
     * @var bool
     */
    protected $needsDateFormatting = true;

    /**
     * @var int
     */
    protected $headingRow = 1;

    /**
     * @var bool
     */
    protected $hasHeading = true;

    /**
     * @var string
     */
    protected $headingType = 'slugged';

    /**
     * @var bool
     */
    protected $ascii = true;

    /**
     * @var string
     */
    protected $separator = '_';

    /**
     * @var bool
     */
    protected $calculatedCellValues = true;

    /**
     * @var int
     */
    protected $skipAmount = 0;

    /**
     * @return array
     */
    public function getSheetIndices()
    {
        return $this->sheetIndices;
    }

    /**
     * @param array $sheetIndices
     * @return $this
     */
    public function setSheetIndices($sheetIndices)
    {
        $this->sheetIndices = $sheetIndices;

        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->columns = array_merge($this->columns, $columns);

        return $this;
    }

    /**
     * @return int
     */
    public function getStartRow()
    {
        return $this->startRow;
    }

    /**
     * @param int $startRow
     * @return $this
     */
    public function setStartRow($startRow)
    {
        $this->startRow = $startRow;

        return $this;
    }

    /**
     * @return int|bool
     */
    public function getMaxRows()
    {
        return $this->maxRows;
    }

    /**
     * @param int|bool $maxRows
     * @return $this
     */
    public function setMaxRows($maxRows)
    {
        if ( $this->getHasHeading() )
        {
            $this->maxRows = (int) 1 + $maxRows;
        }
        else
        {
            $this->maxRows = (int) $maxRows;
        }

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIgnoreEmpty()
    {
        return $this->ignoreEmpty;
    }

    /**
     * @param boolean $ignoreEmpty
     * @return $this
     */
    public function setIgnoreEmpty($ignoreEmpty)
    {
        $this->ignoreEmpty = $ignoreEmpty;

        return $this;
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    /**
     * @param string $dateFormat
     */
    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * @return int
     */
    public function getHeadingRow()
    {
        return $this->headingRow;
    }

    /**
     * @param int $headingRow
     * @return $this
     */
    public function setHeadingRow($headingRow)
    {
        $this->headingRow = $headingRow;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasHeading()
    {
        return $this->hasHeading;
    }

    /**
     * @param boolean $hasHeading
     * @return $this
     */
    public function setHasHeading($hasHeading)
    {
        $this->hasHeading = $hasHeading;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeadingType()
    {
        return $this->headingType;
    }

    /**
     * @param string $headingType
     * @return $this
     */
    public function setHeadingType($headingType)
    {
        $this->headingType = $headingType;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAscii()
    {
        return $this->ascii;
    }

    /**
     * @param boolean $ascii
     * @return $this
     */
    public function setAscii($ascii)
    {
        $this->ascii = $ascii;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * @param string $separator
     * @return $this
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getCalculatedCellValues()
    {
        return $this->calculatedCellValues;
    }

    /**
     * @param boolean $calculatedCellValues
     * @return $this
     */
    public function setCalculatedCellValues($calculatedCellValues)
    {
        $this->calculatedCellValues = $calculatedCellValues;

        return $this;
    }

    /**
     * @return int
     */
    public function getSkipAmount()
    {
        return $this->skipAmount;
    }

    /**
     * @param int $skipAmount
     * @return $this
     */
    public function setSkipAmount($skipAmount)
    {
        $this->skipAmount = $skipAmount;

        return $this;
    }

    /**
     * @return array
     */
    public function getDateColumns()
    {
        return $this->dateColumns;
    }

    /**
     * @param array $dateColumns
     * @return $this
     */
    public function setDateColumns($dateColumns)
    {
        $this->dateColumns = $dateColumns;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getNeedsDateFormatting()
    {
        return $this->needsDateFormatting;
    }

    /**
     * @param boolean $needsDateFormatting
     * @return $this
     */
    public function setNeedsDateFormatting($needsDateFormatting)
    {
        $this->needsDateFormatting = $needsDateFormatting;

        return $this;
    }
}