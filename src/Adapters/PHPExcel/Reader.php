<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel;

use Closure;
use Maatwebsite\Clerk\Adapters\LeagueCsv\Workbook;
use Maatwebsite\Clerk\Adapters\ParserSettings;
use Maatwebsite\Clerk\Adapters\PHPExcel\Parsers\WorkbookParser;
use PHPExcel_IOFactory;
use Maatwebsite\Clerk\Adapters\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Reader as ReaderInterface;

class Reader extends Adapter implements ReaderInterface {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var array
     */
    protected $columns = [];

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
        $reader = PHPExcel_IOFactory::createReader($type);
        $this->driver = $reader->load($file);

        $this->file = $file;

        $this->call($callback);
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
     * @return SheetCollection|RowCollection
     */
    public function get($columns = array())
    {
        // Merge the selected columns
        $columns = array_merge($this->columns, $columns);

        return (new WorkbookParser($this->getDriver(), $this->settings()))->parse($columns);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->driver->getProperties()->getTitle();
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
        list($name, $ext) = explode('.', $file);

        return $name;
    }
}