<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Parsers;

use PHPExcel;
use Maatwebsite\Clerk\Adapters\ParserSettings;
use Maatwebsite\Clerk\Collections\SheetCollection;

/**
 * Class WorkbookParser
 * @package Maatwebsite\Clerk\Adapters\PHPExcel\Parsers
 */
class WorkbookParser {

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
     * Parse the workbook
     * @param PHPExcel $workbook
     * @return SheetCollection
     */
    public function parse(PHPExcel $workbook)
    {
        // Init sheet collection
        $collection = new SheetCollection();

        // Set the workbook title
        $collection->setTitle(
            $workbook->getProperties()->getTitle()
        );

        // Worksheet parser
        $parser = new SheetParser($this->settings);

        // Loop through all worksheets
        foreach ($workbook->getWorksheetIterator() as $index => $worksheet)
        {
            if ( $this->isSelected($index) )
            {
                // Push the sheet onto the workbook
                $collection->push(
                    $parser->parse($worksheet)
                );
            }
        }

        return $collection;
    }

    /**
     * Check if sheet is selected
     * @param $index
     * @return bool
     */
    protected function isSelected($index)
    {
        $sheets = $this->settings->getSheetIndices();

        return empty($sheets) || in_array($index, $sheets);
    }
}