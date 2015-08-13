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
    protected $headers = [];

    /**
     * @var Footer
     */
    protected $footers = [];

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
        $header = new Header(
            $header instanceof Text ? $header : new Text($header)
        );

        $header->call($callback);

        $this->headers[] = $header;

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
        $footer = new Footer(
            $footer instanceof Text ? $footer : new Text($footer)
        );

        $footer->call($callback);

        $this->footers[] = $footer;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getFooters()
    {
        return $this->footers;
    }
}
