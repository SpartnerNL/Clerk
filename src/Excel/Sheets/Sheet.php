<?php

namespace Maatwebsite\Clerk\Excel\Sheets;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Excel\Styles\Styleable;
use Maatwebsite\Clerk\Excel\Styles\StyleableTrait;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Sheet extends Adapter implements Styleable
{
    /*
     * Traits
     */
    use CallableTrait, StyleableTrait;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var mixed
     */
    protected $driver;

    /**
     * @param string  $title
     * @param Closure $callback
     */
    public function __construct($title, Closure $callback = null)
    {
        // Set the title
        $this->setTitle($title);

        // Preform callback on the sheet
        $this->call($callback);
    }

    /**
     * Set the sheet title.
     *
     * @param string $title
     *
     * @return $this
     */
    abstract public function setTitle($title);
}
