<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel;

use Closure;
use Maatwebsite\Clerk\Excel\Sheet as SheetInterface;
use Maatwebsite\Clerk\Excel\Sheets\Sheet as AbstractSheet;
use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;
use PHPExcel_Worksheet;

/**
 * Class Sheet.
 */
class Sheet extends AbstractSheet implements SheetInterface
{
    /**
     * @var PHPExcel_Worksheet
     */
    protected $driver;

    /**
     * @var array
     */
    protected $cells = [];

    /**
     * @var array
     */
    protected $mergeCells = [];

    /**
     * @param WorkbookInterface  $workbook
     * @param                    $title
     * @param Closure            $callback
     * @param PHPExcel_Worksheet $driver
     */
    public function __construct(WorkbookInterface $workbook, $title = 'New sheet', Closure $callback = null, PHPExcel_Worksheet $driver = null)
    {
        // Set PHPExcel worksheet
        $this->driver = $driver ?: new PHPExcel_Worksheet($workbook->getDriver());

        parent::__construct($title, $callback);
    }

    /**
     * Get the sheet title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->driver->getTitle();
    }

    /**
     * Set the sheet title.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->driver->setTitle($title);

        return $this;
    }

    /**
     * Set height for a certain row.
     *
     * @param string|array $row
     * @param int          $height
     *
     * @return $this
     */
    public function setRowHeight($row, $height)
    {
        // if is array of columns
        if (is_array($row)) {
            // Set width for each column
            foreach ($row as $subRow => $subValue) {
                $this->setRowHeight($subRow, $subValue);
            }
        } else {
            // Set column width
            $this->getDriver()
                 ->getRowDimension($row)
                 ->setRowHeight($height);
        }

        return $this;
    }

    /**
     * Set the column width.
     *
     * @param string|array $column
     * @param int          $width
     *
     * @return $this
     */
    public function setColumnWidth($column, $width)
    {
        // if is array of columns
        if (is_array($column)) {
            // Set width for each column
            foreach ($column as $subColumn => $subValue) {
                $this->setColumnWidth($subColumn, $subValue);
            }
        } else {
            // Disable the autosize and set column width
            $this->getDriver()
                 ->getColumnDimension($column)
                 ->setAutoSize(false)
                 ->setWidth($width);
        }

        return $this;
    }

    /**
     * @param string $range
     * @param bool   $alignment
     *
     * @return $this
     */
    public function mergeCells($range = 'A1:A1', $alignment = false)
    {
        $this->mergeCells[] = $range;

        return $this;
    }

    /**
     * @return array
     */
    public function getMergeCells()
    {
        return $this->mergeCells;
    }
}
