<?php

namespace Maatwebsite\Clerk\Pdf\Documents;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Pdf\Page;
use Maatwebsite\Clerk\Pdf\Pages\Text;
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
     * @var Header
     */
    protected $header;

    /**
     * @var Footer
     */
    protected $footer;

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

    /**
     * @param          $header
     * @param callable $callback
     *
     * @return $this
     */
    public function setHeader($header, Closure $callback = null)
    {
        $this->header = new Header(
            new Text($header)
        );

        $this->header->call($callback);

        return $this;
    }

    /**
     * @param          $footer
     * @param callable $callback
     *
     * @return $this
     */
    public function setFooter($footer, Closure $callback = null)
    {
        $this->footer = new Footer(
            new Text($footer)
        );

        $this->footer->call($callback);

        return $this;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return Footer
     */
    public function getFooter()
    {
        return $this->footer;
    }
}
