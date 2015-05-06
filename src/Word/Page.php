<?php

namespace Maatwebsite\Clerk\Word;

interface Page
{
    /**
     * @param $text
     *
     * @return $this
     */
    public function addText($text);

    /**
     * @param $text
     *
     * @return $this
     */
    public function addHtml($text);

    /**
     * @param $header
     *
     * @return $this
     */
    public function setHeader($header);

    /**
     * @param $footer
     *
     * @return $this
     */
    public function setFooter($footer);

    /**
     * @return array
     */
    public function getText();

    /**
     * @return string
     */
    public function getHeader();

    /**
     * @return string
     */
    public function getFooter();
}
