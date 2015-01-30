<?php namespace Maatwebsite\Clerk\Adapters\LeagueCsv;

use Closure;
use SplTempFileObject;
use League\Csv\Writer as LeagueWriter;
use Maatwebsite\Clerk\Adapters\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Sheet as SheetInterface;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;

/**
 * Class Sheet
 * @package Maatwebsite\Clerk\Adapters\LeagueCsv
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
     * @var LeagueWriter
     */
    protected $driver;

    /**
     * @var WorkbookInterface
     */
    protected $workbook;

    /**
     * @param WorkbookInterface   $workbook
     * @param                     $title
     * @param Closure            $callback
     * @param LeagueWriter        $driver
     */
    public function __construct(WorkbookInterface $workbook, $title = null, Closure $callback = null, LeagueWriter $driver = null)
    {
        // Set PHPExcel worksheet
        $this->driver = $driver ?: $workbook->getDriver();

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
     * @param array   $source
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
}