<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel;

use Closure;
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
    public function __construct(WorkbookInterface $workbook, $title = null, Closure $callback = null, PHPExcel_Worksheet $driver = null)
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

        dd($html);
    }
}