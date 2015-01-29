<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Parsers;

use Maatwebsite\Clerk\Adapters\ParserSettings;
use PHPExcel;
use Maatwebsite\Clerk\Collections\SheetCollection;

class WorkbookParser {

    /**
     * @var PHPExcel_WorksheetIterator
     */
    protected $workbook;

    /**
     * @var ParserSettings
     */
    private $settings;

    /**
     * @param PHPExcel       $workbook
     * @param ParserSettings $settings
     */
    public function __construct(PHPExcel $workbook, ParserSettings $settings)
    {
        $this->workbook = $workbook;
        $this->settings = $settings;
    }

    /**
     * Parse the workbook
     * @return SheetCollection
     */
    public function parse()
    {
        // Init sheet collection
        $collection = new SheetCollection();

        // Set the workbook title
        $collection->setTitle(
            $this->workbook->getProperties()->getTitle()
        );

        // Worksheet parser
        $parser = new SheetParser($this->settings);

        // Loop through all worksheets
        foreach ($this->workbook->getWorksheetIterator() as $index => $worksheet)
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