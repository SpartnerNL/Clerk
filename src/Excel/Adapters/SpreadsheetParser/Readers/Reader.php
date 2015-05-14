<?php

namespace Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser\Readers;

use Akeneo\Component\SpreadsheetParser\SpreadsheetInterface;
use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;
use Closure;
use Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser\Parsers\WorkbookParser;
use Maatwebsite\Clerk\Excel\Readers\Reader as AbstractReader;
use Maatwebsite\Clerk\Traits\CallableTrait;

/**
 * Class Reader.
 */
class Reader extends AbstractReader
{
    /*
     * Traits
     */
    use CallableTrait;

    /**
     * @var SpreadsheetParser
     */
    protected $reader;

    /**
     * @param string  $type
     * @param string  $file
     * @param Closure $callback
     */
    public function __construct($type, $file, Closure $callback = null)
    {
        $this->file = $file;

        $this->call($callback);
    }

    /**
     * Get all sheets/rows.
     *
     * @param array $columns
     *
     * @return \Illuminate\Support\Collection
     */
    public function get($columns = [])
    {
        // Load the file
        ini_set('auto_detect_line_endings', true);
        $this->driver = SpreadsheetParser::open($this->file);

        // Set selected columns
        $this->settings()->setColumns($columns);

        return (new WorkbookParser($this->settings()))->parse($this->getWorkbook());
    }

    /**
     * @return SpreadsheetInterface
     */
    protected function getWorkbook()
    {
        return $this->getDriver();
    }
}
