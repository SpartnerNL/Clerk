<?php

namespace Maatwebsite\Clerk\Excel\Html;

use DOMDocument;
use Maatwebsite\Clerk\Excel\Html\Elements\Document;
use Maatwebsite\Clerk\Excel\Sheet;
use Maatwebsite\Clerk\Exceptions\ExportFailedException;

class HtmlToSheetConverter
{
    /**
     * Convert html to a sheet.
     *
     * @param       $html
     * @param Sheet $sheet
     *
     * @throws ExportFailedException
     * @return Sheet
     */
    public function convert($html, Sheet $sheet)
    {
        $document = new DOMDocument();

        // Load the Html into the DOMDocument
        if (!$document->loadHTML($this->getNormalizedHtml($html), $this->getXmlReaderOptions())) {
            throw new ExportFailedException('Failed to load the template');
        }

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
     * @param $html
     *
     * @return bool|mixed|string
     */
    public function getNormalizedHtml($html)
    {
        return mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
    }

    /**
     * Get the reader options.
     *
     * @return int
     */
    protected function getXmlReaderOptions()
    {
        @libxml_disable_entity_loader(true);

        return LIBXML_DTDLOAD | LIBXML_DTDATTR;
    }
}
