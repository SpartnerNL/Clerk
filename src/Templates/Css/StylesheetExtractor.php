<?php namespace Maatwebsite\Clerk\Templates\Css;

use DOMDocument;

class StylesheetExtractor {

    /**
     * @var string
     */
    protected $html;

    /**
     * @param string $html
     */
    public function __construct($html)
    {
        $this->html = $html;

        $document = new DOMDocument();
        $document->loadHTML($this->html);
        $this->xml = simplexml_import_dom($document);
    }

    /**
     * @return array
     */
    public function extract()
    {
        $links = [];

        foreach ($this->findByStylesheetTag() as $node)
        {
            $link = $this->getCleanStylesheetLink($node);
            $links[$link] = $this->getCssFromLink($link);
        }

        return $links;
    }

    /**
     * Find the stylesheet path
     * @return \SimpleXMLElement[]
     */
    protected function findByStylesheetTag()
    {
        return $this->xml->xpath('//link[@rel="stylesheet"]');
    }

    /**
     * Get clean stylesheet link
     * @param $node
     * @return mixed
     */
    protected function getCleanStylesheetLink($node)
    {
        // Get the link
        $link = $node->attributes()->href;

        return (string) $link;
    }

    /**
     * Get css from link
     * @param  string $link
     * @return string|boolean
     */
    protected function getCssFromLink($link)
    {
        return file_get_contents($link);
    }
}