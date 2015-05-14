<?php

namespace Maatwebsite\Clerk\Pdf;

use Closure;
use Maatwebsite\Clerk\Writers\Exportable;

interface Document extends Exportable
{
    /**
     * Set title.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * Init a new page.
     *
     * @param         $text
     * @param Closure $callback
     *
     * @return Page
     */
    public function page($text = null, Closure $callback = null);

    /**
     * @param Page $page
     *
     * @return mixed
     */
    public function addPage(Page $page);

    /**
     * @return array|Page[]
     */
    public function getPages();
}
