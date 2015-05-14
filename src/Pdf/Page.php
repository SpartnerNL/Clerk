<?php

namespace Maatwebsite\Clerk\Pdf;

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
     * Load from template.
     *
     * @param       $template
     * @param array $data
     * @param null  $engine
     *
     * @return mixed
     */
    public function loadTemplate($template, array $data = [], $engine = null);

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
