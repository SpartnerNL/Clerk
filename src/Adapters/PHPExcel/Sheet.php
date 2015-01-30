<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel;

use Closure;
use PHPExcel_Worksheet;
use Maatwebsite\Clerk\Adapters\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Sheet as SheetInterface;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;

/**
 * Class Sheet
 * @package Maatwebsite\Clerk\Adapters\PHPExcel
 */
class Sheet extends Adapter implements SheetInterface {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var PHPExcel_Worksheet
     */
    protected $driver;

    /**
     * @param WorkbookInterface   $workbook
     * @param                     $title
     * @param callable            $callback
     * @param PHPExcel_Worksheet  $driver
     */
    public function __construct(WorkbookInterface $workbook, $title = null, Closure $callback = null, PHPExcel_Worksheet $driver = null)
    {
        // Set PHPExcel worksheet
        $this->driver = $driver ?: new PHPExcel_Worksheet($workbook->getDriver());

        // Set the title
        $this->setTitle($title);

        // Preform callback on the sheet
        $this->call($callback);
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
     * @return string
     */
    public function setTitle($title)
    {
        $this->driver->setTitle($title);

        return $this;
    }

    /**
     * @param null   $source
     * @param null   $nullValue
     * @param string $startCell
     * @param bool   $strictNullComparison
     * @return $this
     * @throws \PHPExcel_Exception
     */
    public function fromArray($source = null, $nullValue = null, $startCell = 'A1', $strictNullComparison = false)
    {
        $this->driver->fromArray($source, $nullValue, $startCell, $strictNullComparison);

        return $this;
    }
}