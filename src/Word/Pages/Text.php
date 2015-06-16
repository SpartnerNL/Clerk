<?php

namespace Maatwebsite\Clerk\Word\Pages;

use Maatwebsite\Clerk\Traits\CallableTrait;

class Text
{
    use CallableTrait;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var null
     */
    protected $styleFont;

    /**
     * @var null
     */
    protected $styleParagraph;

    /**
     * @param string $text
     * @param null   $styleFont
     * @param null   $styleParagraph
     * @internal param array $options
     */
    public function __construct($text, $styleFont = null, $styleParagraph = null)
    {
        $this->text           = $text;
        $this->styleFont      = $styleFont;
        $this->styleParagraph = $styleParagraph;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return null
     */
    public function getStyleFont()
    {
        return $this->styleFont;
    }

    /**
     * @param null $styleFont
     */
    public function setStyleFont($styleFont)
    {
        $this->styleFont = $styleFont;
    }

    /**
     * @return null
     */
    public function getStyleParagraph()
    {
        return $this->styleParagraph;
    }

    /**
     * @param null $styleParagraph
     */
    public function setStyleParagraph($styleParagraph)
    {
        $this->styleParagraph = $styleParagraph;
    }
}
