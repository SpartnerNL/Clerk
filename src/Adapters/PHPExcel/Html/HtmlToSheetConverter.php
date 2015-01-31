<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html;

use DOMDocument;
use Maatwebsite\Clerk\Sheet;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements\Document;

class HtmlToSheetConverter {

    /**
     * Convert html to a sheet
     * @param       $html
     * @param Sheet $sheet
     * @return Sheet
     * @throws ExportFailedException
     */
    public function convert($html, Sheet $sheet)
    {
        $document = new DOMDocument();

        // Load the Html into the DOMDocument
        if ( !$document->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), $this->getXmlReaderOptions()) )
            throw new ExportFailedException('Failed to load the template');

        // Discard white space
        $document->preserveWhiteSpace = false;

        // Parse the dom document
        (new Document($sheet))->parse(
            $document,
            new ReferenceTable()
        );

        return $sheet;
    }

    /**
     * Get the reader options
     * @return int
     */
    protected function getXmlReaderOptions()
    {
        @libxml_disable_entity_loader(true);

        return LIBXML_DTDLOAD | LIBXML_DTDATTR;
    }
}