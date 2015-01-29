<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel;

use Carbon\Carbon;
use Maatwebsite\Clerk\Adapters\ParserSettings;
use PHPExcel_Cell;
use PHPExcel_Shared_Date;
use PHPExcel_Style_NumberFormat;

class Cell {

    /**
     * @var PHPExcel_Cell
     */
    protected $cell;

    /**
     * @var ParserSettings
     */
    protected $settings;

    /**
     * @var string|integer
     */
    protected $index;

    /**
     * @param PHPExcel_Cell  $cell
     * @param                $index
     * @param ParserSettings $settings
     */
    public function __construct(PHPExcel_Cell $cell, $index, ParserSettings $settings)
    {
        $this->cell = $cell;
        $this->settings = $settings;
        $this->index = $index;
    }

    /**
     * @return string|Carbon
     */
    public function getValue()
    {
        if ( $this->cellIsDate() )
        {
            return $this->parseDate();
        }
        elseif ( $this->needsCalculatedValue() )
        {
            return $this->getCalculatedValue();
        }
        else
        {
            return $this->getCellValue();
        }
    }

    /**
     * Get cell
     * @return mixed
     */
    public function getCell()
    {
        return $this->cell;
    }


    /**
     * Get calculated cell value
     * @return string
     */
    public function getCalculatedValue()
    {
        return $this->cell->getCalculatedValue();
    }

    /**
     * Get cell value
     * @return string
     */
    public function getCellValue()
    {
        return $this->cell->getValue();
    }

    /**
     * Parse the date
     * @return Carbon|string
     */
    protected function parseDate()
    {
        // If the date needs formatting
        if ( $this->settings->getNeedsDateFormatting() )
        {
            // Parse the date with carbon
            return $this->parseDateAsCarbon();
        }
        else
        {
            // Parse the date as a normal string
            return $this->parseDateAsString();
        }
    }

    /**
     * Parse and return carbon object or formatted time string
     * @return Carbon
     */
    protected function parseDateAsCarbon()
    {
        // If has a date
        if ( $cellContent = $this->cell->getCalculatedValue() )
        {
            // Convert excel time to php date object
            $date = PHPExcel_Shared_Date::ExcelToPHPObject($this->cell->getCalculatedValue())->format('Y-m-d H:i:s');

            // Parse with carbon
            $date = Carbon::parse($date);

            // Format the date if wanted
            return $this->settings->getDateFormat() ? $date->format($this->settings->getDateFormat()) : $date;
        }

        return null;
    }

    /**
     * Return date string
     * @return string
     */
    protected function parseDateAsString()
    {
        //Format the date to a formatted string
        return (string) PHPExcel_Style_NumberFormat::toFormattedString(
            $this->cell->getCalculatedValue(),
            $this->cell->getWorksheet()->getParent()
                       ->getCellXfByIndex($this->cell->getXfIndex())
                       ->getNumberFormat()
                       ->getFormatCode()
        );
    }

    /**
     * Check if the cell is a date
     * @return bool
     */
    protected function cellIsDate()
    {
        // For date formatting for certain given columns
        if ( $this->settings->getDateColumns() )
        {
            return in_array($this->index, $this->reader->getDateColumns());
        }
        else
        {
            return PHPExcel_Shared_Date::isDateTime($this->cell);
        }
    }

    /**
     * Check if cell needs calculating
     * @return bool
     */
    protected function needsCalculatedValue()
    {
        return $this->settings->getCalculatedCellValues();
    }

    /**
     * Dynamic calls
     * @param $method
     * @param $params
     */
    public function __call($method, $params)
    {
        if ( method_exists($this->getCell(), $method) )
            call_user_func_array([$this->getCell(), $method], $params);

        throw new \BadMethodCallException("[{$method}] does not exist on the Cell object");
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }
}