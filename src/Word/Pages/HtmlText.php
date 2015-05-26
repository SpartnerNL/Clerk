<?php

namespace Maatwebsite\Clerk\Word\Pages;

class HtmlText extends Text
{
    /**
     * @var bool
     */
    protected $fullHtml;

    /**
     * @param string $text
     * @param bool   $fullHtml
     */
    public function __construct($text, $fullHtml = false)
    {
        $this->text     = $text;
        $this->fullHtml = $fullHtml;
    }

    /**
     * @return bool
     */
    public function isFullHtml()
    {
        return $this->fullHtml;
    }

    /**
     * @param bool $fullHtml
     *
     * @return $this
     */
    public function setIsFullHtml($fullHtml = true)
    {
        $this->fullHtml = $fullHtml;

        return $this;
    }
}
