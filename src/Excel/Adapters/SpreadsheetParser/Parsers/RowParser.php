<?php

namespace Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser\Parsers;

use Maatwebsite\Clerk\Excel\Collections\CellCollection;
use Maatwebsite\Clerk\Excel\Readers\ParserSettings;

/**
 * Class RowParser.
 */
class RowParser
{
    /**
     * @var ParserSettings
     */
    protected $settings;

    /**
     * @var array
     */
    protected $heading;

    /**
     * @param ParserSettings $settings
     * @param array          $heading
     */
    public function __construct(ParserSettings $settings, array $heading = [])
    {
        $this->settings = $settings;
        $this->heading  = $heading;
    }

    /**
     * @param array $row
     *
     * @return CellCollection
     */
    public function parse(array $row = [])
    {
        $cells = [];

        foreach ($row as $index => $cell) {
            $index = ($this->settings->getHasHeading() && isset($this->heading[$index])) ? $this->heading[$index] : $index;

            $cells[$index] = $cell;
        }

        return new CellCollection($cells);
    }
}
