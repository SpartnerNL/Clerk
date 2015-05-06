<?php

namespace Maatwebsite\Clerk\Word\Pages;

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
     * @var array
     */
    protected $text = [];

    /**
     * @var string
     */
    protected $header;

    /**
     * @var string
     */
    protected $footer;

    /**
     * @param $text
     *
     * @return $this
     */
    public function addText($text)
    {
        $this->text[] = $text;

        return $this;
    }

    /**
     * @param $header
     *
     * @return $this
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @param $footer
     *
     * @return $this
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * @return array
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return mixed
     */
    public function getFooter()
    {
        return $this->footer;
    }
}
