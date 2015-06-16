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
     * @return array
     */
    public function getText();
}
