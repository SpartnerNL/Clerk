<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel;

use Closure;
use PHPExcel_Worksheet;
use Maatwebsite\Clerk\Templates\TemplateFactory;
use Maatwebsite\Clerk\Excel\Cell as CellInterface;
use Maatwebsite\Clerk\Excel\Sheet as SheetInterface;
use Maatwebsite\Clerk\Excel\Cells\Cell as AbstractCell;
use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Excel\Sheets\Sheet as AbstractSheet;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\HtmlToSheetConverter;

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
     * @var array
     */
    protected $cells = array();

    /**
     * @var array
     */
    protected $mergeCells = array();

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
     * @return $this
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
     * @return $this
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

    /**
     * New cell
     * @param  array|string       $coordinate
     * @param Closure|string|null $callback
     * @return $this
     */
    public function cell($coordinate, $callback = null)
    {
        if ( $this->cellExists($coordinate) )
        {
            $cell = $this->getCellByCoordinate($coordinate);
        }
        else
        {
            $cell = new AbstractCell();
        }

        // If the cell already exists the driver (e.g. set with fromArray)
        // TODO: try to get rid of this
        if ( $content = $this->getDriver()->getCell($coordinate) )
        {
            $cell->setValue($content->getValue());
            $cell->setDataType($content->getDataType());
        }

        // Set coordinates
        $cell->setCoordinate($coordinate);

        if ( is_callable($callback) )
        {
            $cell->call($callback);
        }
        elseif ( !is_null($callback) )
        {
            $cell->setValue($callback);
        }

        $this->addCell($cell);

        return $this;
    }

    /**
     * Add a cell
     * @param CellInterface $cell
     * @return mixed
     */
    public function addCell(CellInterface $cell)
    {
        $this->cells[$cell->getCoordinate()->get()] = $cell;
    }

    /**
     * @return CellInterface[]
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param $coordinate
     * @return bool
     */
    public function cellExists($coordinate)
    {
        return in_array($coordinate, array_keys($this->getCells()));
    }

    /**
     * @param $coordinate
     * @return mixed
     */
    public function getCellByCoordinate($coordinate)
    {
        if ( $this->cellExists($coordinate) )
            return $this->cells[$coordinate];
    }
}