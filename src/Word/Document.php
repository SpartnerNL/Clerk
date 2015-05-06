<?php

namespace Maatwebsite\Clerk\Word;

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
}
