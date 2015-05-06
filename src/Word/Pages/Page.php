<?php

namespace Maatwebsite\Clerk\Word\Pages;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Page extends Adapter
{
    /*
     * Traits
     */
    use CallableTrait;

    /**
     * @var mixed
     */
    protected $driver;

    /**
     * @var array|Text[]
     */
    protected $text = [];

    /**
     * @var Header
     */
    protected $header;

    /**
     * @var Footer
     */
    protected $footer;

    /**
     * @param          $text
     * @param callable $callback
     *
     * @return $this
     */
    public function addText($text, Closure $callback = null)
    {
        $text = new Text($text);

        $text->call($callback);

        $this->text[] = $text;

        return $this;
    }

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
     * @return array|Text[]
     */
    public function getText()
    {
        return $this->text;
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
