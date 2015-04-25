<?php

namespace Maatwebsite\Clerk\Excel\Adapters\LeagueCsv;

use Closure;
use League\Csv\Writer as LeagueWriter;
use Maatwebsite\Clerk\Excel\Sheet as SheetInterface;
use Maatwebsite\Clerk\Excel\Sheets\Sheet as AbstractSheet;
use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Exceptions\FeaturedNotSupportedException;

/**
 * Class Sheet.
 */
class Sheet extends AbstractSheet implements SheetInterface
{
    /**
     * @var LeagueWriter
     */
    protected $driver;

    /**
     * @var array
     */
    protected $cells = [];

    /**
     * @param WorkbookInterface $workbook
     * @param                   $title
     * @param Closure           $callback
     * @param LeagueWriter      $driver
     */
    public function __construct(
        WorkbookInterface $workbook,
        $title = null,
        Closure $callback = null,
        LeagueWriter $driver = null
    ) {
        // Set PHPExcel worksheet
        $this->driver = $driver ?: $workbook->getDriver();

        parent::__construct($title, $callback);
    }

    /**
     * Get the sheet title.
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
        $this->title = $title;

        return $this;
    }

    /**
     * Set height for a certain row.
     *
     * @param $row
     * @param $height
     *
     * @throws FeaturedNotSupportedException
     * @return $this
     */
    public function setRowHeight($row, $height)
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * Set the column width.
     *
     * @param $column
     * @param $width
     *
     * @throws FeaturedNotSupportedException
     * @return mixed
     */
    public function setColumnWidth($column, $width)
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * @param string $range
     * @param bool   $alignment
     *
     * @throws FeaturedNotSupportedException
     * @return $this
     */
    public function mergeCells($range = 'A1:A1', $alignment = false)
    {
        throw new FeaturedNotSupportedException();
    }

    /**
     * @throws FeaturedNotSupportedException
     * @return array
     */
    public function getMergeCells()
    {
        throw new FeaturedNotSupportedException();
    }
}
