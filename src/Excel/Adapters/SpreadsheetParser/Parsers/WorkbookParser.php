<?php

namespace Maatwebsite\Clerk\Excel\Adapters\SpreadsheetParser\Parsers;

use Akeneo\Component\SpreadsheetParser\SpreadsheetInterface;
use Maatwebsite\Clerk\Excel\Collections\SheetCollection;
use Maatwebsite\Clerk\Excel\Readers\ParserSettings;

/**
 * Class WorkbookParser.
 */
class WorkbookParser
{
    /**
     * @var ParserSettings
     */
    protected $settings;

    /**
     * @param ParserSettings $settings
     */
    public function __construct(ParserSettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Parse the workbook.
     *
     * @param SpreadsheetInterface $workbook
     *
     * @return SheetCollection
     */
    public function parse(SpreadsheetInterface $workbook)
    {
        // Init sheet collection
        $collection = new SheetCollection();

        // Sheet parser
        $parser = new SheetParser($this->settings);

        // Loop through all worksheets
        foreach ($workbook->getWorksheets() as $worksheet) {
            $index = $workbook->getWorksheetIndex($worksheet);

            if ($this->isSelected($index)) {
                // Push the sheet onto the workbook
                $collection->push(
                    $parser->parse($workbook, $worksheet, $index)
                );
            }
        }

        return $collection;
    }

    /**
     * Check if sheet is selected.
     *
     * @param $index
     *
     * @return bool
     */
    protected function isSelected($index)
    {
        $sheets = $this->settings->getSheetIndices();

        return empty($sheets) || in_array($index, $sheets);
    }
}
