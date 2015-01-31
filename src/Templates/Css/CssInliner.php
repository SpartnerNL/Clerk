<?php namespace Maatwebsite\Clerk\Templates\Css;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class CssInliner {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inliner = new CssToInlineStyles();
        $this->inliner->setCleanup(true);
        $this->inliner->setUseInlineStylesBlock(true);
        $this->inliner->setStripOriginalStyleTags(true);
    }

    /**
     * @param $html
     * @return string
     */
    public function transformCssToInlineStyles($html)
    {
        $this->inliner->setHTML($html);

        foreach ($this->getStylesheets($html) as $css)
        {
            $this->inliner->setCSS($css);
        }

        return $this->inliner->convert();
    }

    /**
     * @param $html
     * @return mixed
     */
    protected function getStylesheets($html)
    {
        return (new StylesheetExtractor($html))->extract();
    }
}