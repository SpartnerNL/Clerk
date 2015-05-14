<?php

namespace Maatwebsite\Clerk\Pdf\Documents;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Pdf\Page;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Document extends Adapter
{
    /*
     * Traits
     */
    use CallableTrait;

    /**
     * @var array|Page[]
     */
    protected $pages = [];

    /**
     * @param         $title
     * @param Closure $callback
     */
    public function __construct($title, Closure $callback = null)
    {
        // Set workbook title
        $this->setTitle($title);

        // Make a callback on the workbook
        $this->call($callback);
    }

    /**
     * @param Page $page
     */
    public function addPage(Page $page)
    {
        $this->pages[] = $page;
    }

    /**
     * @return array|Page[]
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return $this
     */
    abstract public function setTitle($title);
}
