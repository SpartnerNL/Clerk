<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel;

use Closure;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\HtmlToSheetConverter;
use PHPExcel_Worksheet;
use Maatwebsite\Clerk\Sheet as SheetInterface;
use Maatwebsite\Clerk\Templates\TemplateFactory;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Adapters\Sheet as AbstractSheet;

/**
 * Class Sheet
 * @package Maatwebsite\Clerk\Adapters\PHPExcel
 */
class Sheet extends AbstractSheet implements SheetInterface {

    /**
     * @var PHPExcel_Worksheet
     */
    protected $driver;

    /**
     * @param WorkbookInterface   $workbook
     * @param                     $title
     * @param Closure             $callback
     * @param PHPExcel_Worksheet  $driver
     */
    public function __construct(WorkbookInterface $workbook, $title = 'New sheet', Closure $callback = null, PHPExcel_Worksheet $driver = null)
    {
        // Set PHPExcel worksheet
        $this->driver = $driver ?: new PHPExcel_Worksheet($workbook->getDriver());

        parent::__construct($title, $callback);
    }

    /**
     * Get the sheet title
     * @return string
     */
    public function getTitle()
    {
        return $this->driver->getTitle();
    }

    /**
     * Set the sheet title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->driver->setTitle($title);

        return $this;
    }

    /**
     * @param array  $source
     * @param null   $nullValue
     * @param string $startCell
     * @param bool   $strictNullComparison
     * @return $this
     * @throws \PHPExcel_Exception
     */
    public function fromArray(array $source, $nullValue = null, $startCell = 'A1', $strictNullComparison = false)
    {
        $this->driver->fromArray($source, $nullValue, $startCell, $strictNullComparison);

        return $this;
    }

    /**
     * Load from template
     * @param       $template
     * @param array $data
     * @param null  $engine
     * @return mixed
     */
    public function loadTemplate($template, array $data = array(), $engine = null)
    {
        // Init factory based on given engine, based on extension or use of default engine
        $factory = TemplateFactory::create($template, $engine);

        // Render the template
        $html = $factory->make($template, $data)->render();

        // Convert the html to a sheet
        (new HtmlToSheetConverter())->convert(
            $html,
            $this
        );

        return $this;
    }

    /**
     * Set value for a cell for given coordinate
     * @param string      $coordinate
     * @param string|null $value
     * @param bool        $returnCell
     * @return mixed
     */
    public function setCellValue($coordinate = 'A1', $value = null, $returnCell = false)
    {
        return $this->driver->setCellValue($coordinate, $value, $returnCell);
    }

    /**
     * Set height for a certain row
     * @param string|array $row
     * @param integer      $height
     * @return $this
     */
    public function setRowHeight($row, $height)
    {
        // if is array of columns
        if ( is_array($row) )
        {
            // Set width for each column
            foreach ($row as $subRow => $subValue)
            {
                $this->setRowHeight($subRow, $subValue);
            }
        }
        else
        {
            // Set column width
            $this->getDriver()
                 ->getRowDimension($row)
                 ->setRowHeight($height);
        }

        return $this;
    }

    /**
     * Set the column width
     * @param string|array $column
     * @param integer      $width
     * @return mixed
     */
    public function setColumnWidth($column, $width)
    {
        // if is array of columns
        if ( is_array($column) )
        {
            // Set width for each column
            foreach ($column as $subColumn => $subValue)
            {
                $this->setColumnWidth($subColumn, $subValue);
            }
        }
        else
        {
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
     * @return $this
     */
    public function mergeCells($range = 'A1:A1', $alignment = false)
    {
        $this->getDriver()->mergeCells($range);
        // TODO: Do cell alignment stuff

        return $this;
    }
}