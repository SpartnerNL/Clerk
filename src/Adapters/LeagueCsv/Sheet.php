<?php namespace Maatwebsite\Clerk\Adapters\LeagueCsv;

use Closure;
use League\Csv\Writer as LeagueWriter;
use Maatwebsite\Clerk\Adapters\Adapter;
use Maatwebsite\Clerk\Adapters\Sheet as AbstractSheet;
use Maatwebsite\Clerk\Cell;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Sheet as SheetInterface;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;

/**
 * Class Sheet
 * @package Maatwebsite\Clerk\Adapters\LeagueCsv
 */
class Sheet extends AbstractSheet implements SheetInterface {

    /**
     * @var LeagueWriter
     */
    protected $driver;

    /**
     * @param WorkbookInterface   $workbook
     * @param                     $title
     * @param Closure             $callback
     * @param LeagueWriter        $driver
     */
    public function __construct(WorkbookInterface $workbook, $title = null, Closure $callback = null, LeagueWriter $driver = null)
    {
        // Set PHPExcel worksheet
        $this->driver = $driver ?: $workbook->getDriver();

        parent::__construct($title, $callback);
    }

    /**
     * Get the sheet title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the sheet title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param array  $source
     * @param null   $nullValue
     * @param string $startCell
     * @param bool   $strictNullComparison
     * @return SheetInterface
     */
    public function fromArray(array $source, $nullValue = null, $startCell = 'A1', $strictNullComparison = false)
    {
        if ( $nullValue == null && $strictNullComparison == false )
        {
            $this->driver->setNullHandlingMode('NULL_AS_EMPTY');
        }
        elseif ( $nullValue == 0 || $strictNullComparison )
        {
            $this->driver->setNullHandlingMode('NULL_HANDLING_DISABLED');
        }

        $this->driver->insertAll($source);

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
        // TODO: Implement loadTemplate() method.
    }

    /**
     * Set height for a certain row
     * @param $row
     * @param $height
     * @return $this
     */
    public function setRowHeight($row, $height)
    {
        return $this;
    }

    /**
     * Set the column width
     * @param $column
     * @param $width
     * @return mixed
     */
    public function setColumnWidth($column, $width)
    {
        return $this;
    }

    /**
     * @param string $range
     * @param bool   $alignment
     * @return $this
     */
    public function mergeCells($range = 'A1:A1', $alignment = false)
    {
        return $this;
    }

    /**
     * New cell
     * @param array|string        $cell
     * @param Closure|string|null $callback
     * @return mixed
     */
    public function cell($cell, $callback = null)
    {
        // TODO: Implement cell() method.
    }

    /**
     * Add a cell
     * @param Cell $cell
     * @return mixed
     */
    public function addCell(Cell $cell)
    {
        // TODO: Implement addCell() method.
    }

    /**
     * @return Cell[]
     */
    public function getCells()
    {
        // TODO: Implement getCells() method.
    }

    /**
     * @return array
     */
    public function getMergeCells()
    {
        // TODO: Implement getMergeCells() method.
    }
}