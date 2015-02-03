<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Readers;

use Closure;
use PHPExcel;
use PHPExcel_IOFactory;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Excel\Readers\ParserSettings;
use Maatwebsite\Clerk\Excel\Reader as ReaderInterface;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Parsers\WorkbookParser;

/**
 * Class Reader
 * @package Maatwebsite\Clerk\Adapters\PHPExcel
 */
class Reader extends Adapter implements ReaderInterface {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var \PHPExcel_Reader_IReader
     */
    protected $reader;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var ParserSettings
     */
    protected $settings;

    /**
     * @param string  $type
     * @param string  $file
     * @param Closure $callback
     */
    public function __construct($type, $file, Closure $callback = null)
    {
        $this->setWriter($type);
        $this->file = $file;

        $this->call($callback);
    }

    /**
     * Set the writer
     * @param $type
     */
    protected function setWriter($type)
    {
        $this->reader = PHPExcel_IOFactory::createReader($type);
    }

    /**
     * Settings
     * @return ParserSettings
     */
    public function settings()
    {
        return $this->settings ?: $this->settings = new ParserSettings();
    }

    /**
     * Get all sheets/rows
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function get($columns = array())
    {
        // Load the file
        $this->driver = $this->reader->load($this->file);

        // Set selected columns
        $this->settings()->setColumns($columns);

        return (new WorkbookParser($this->settings()))->parse($this->getWorkbook());
    }

    /**
     * Take x rows
     * @param  int $amount
     * @return $this
     */
    public function take($amount)
    {
        $this->settings()->setMaxRows($amount);

        return $this;
    }

    /**
     * Skip x rows
     * @param  int $amount
     * @return $this
     */
    public function skip($amount)
    {
        $this->settings()->setStartRow($amount);

        return $this;
    }

    /**
     * Limit the results by x
     * @param  int $take
     * @param  int $skip
     * @return $this
     */
    public function limit($take, $skip = 0)
    {
        // Skip x records
        $this->skip($skip);

        // Take x records
        $this->take($take);

        return $this;
    }

    /**
     * Select certain columns
     * @param  array $columns
     * @return $this
     */
    public function select($columns = array())
    {
        $this->settings()->setColumns($columns);

        return $this;
    }

    /**
     * Return all sheets/rows
     * @param  array $columns
     * @return \Illuminate\Support\Collection
     */
    public function all($columns = array())
    {
        return $this->get($columns);
    }

    /**
     * Get first row/sheet only
     * @param  array $columns
     * @return \Illuminate\Support\Collection
     */
    public function first($columns = array())
    {
        return $this->take(1)->get($columns)->first();
    }

    /**
     * Parse the file in chunks
     * @param int $size
     * @param     $callback
     * @throws \Exception
     * @return void
     */
    public function chunk($size = 10, $callback = null)
    {
        //
    }

    /**
     * Each
     * @param  Closure $callback
     * @return \Illuminate\Support\Collection
     */
    public function each(Closure $callback)
    {
        return $this->get()->each($callback);
    }

    /**
     *  Parse the file to an array.
     * @param  array $columns
     * @return array
     */
    public function toArray($columns = array())
    {
        return (array) $this->get($columns)->toArray();
    }

    /**
     * Select sheets by their indices
     * @param array $sheets
     * @return Reader
     */
    public function selectSheets($sheets = array())
    {
        $this->settings()->setSheetIndices($sheets);

        return $this;
    }

    /**
     * Ignore empty cells
     * @param $value
     * @return ParserSettings
     */
    public function ignoreEmpty($value)
    {
        return $this->settings()->setIgnoreEmpty($value);
    }

    /**
     * Set the date format
     * @param $format
     * @return mixed
     */
    public function setDateFormat($format)
    {
        return $this->settings()->setDateFormat($format);
    }

    /**
     * Set date columns
     * @param array $columns
     * @return ParserSettings
     */
    public function setDateColumns($columns = array())
    {
        return $this->settings()->setDateColumns($columns);
    }

    /**
     * Workbook needs date formatting
     * @param $state
     * @return ParserSettings
     */
    public function needsDateFormatting($state)
    {
        return $this->settings()->setNeedsDateFormatting($state);
    }

    /**
     * Set the heading row
     * @param $row
     * @return ParserSettings
     */
    public function setHeadingRow($row)
    {
        return $this->settings()->setHeadingRow($row);
    }

    /**
     * Has heading row
     * @param $state
     * @return ParserSettings
     */
    public function hasHeading($state)
    {
        return $this->settings()->setHasHeading($state);
    }

    /**
     * Set the heading type
     * @param $type
     * @return ParserSettings
     */
    public function setHeadingType($type)
    {
        return $this->settings()->setHeadingType($type);
    }

    /**
     * Set separator
     * @param $separator
     * @return ParserSettings
     */
    public function setSeparator($separator)
    {
        return $this->settings()->setSeparator($separator);
    }

    /**
     * Calculate cell values
     * @param $state
     * @return ParserSettings
     */
    public function calculate($state)
    {
        return $this->settings()->setCalculatedCellValues($state);
    }

    /**
     * Get the current filename
     * @return mixed
     */
    public function getFileName()
    {
        $filename = $this->file;
        $segments = explode('/', $filename);
        $file = end($segments);
        list($name,) = explode('.', $file);

        return $name;
    }

    /**
     * @return \PHPExcel_Reader_IReader
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @return PHPExcel
     */
    protected function getWorkbook()
    {
        return $this->getDriver();
    }

    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        if ( method_exists($this->settings(), $method) )
            return call_user_func_array([$this->settings(), $method], $params);

        if ( method_exists($this->getReader(), $method) )
            return call_user_func_array([$this->getReader(), $method], $params);

        parent::__call($method, $params);
    }
}