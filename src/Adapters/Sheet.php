<?php namespace Maatwebsite\Clerk\Adapters;

use Closure;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Sheet extends Adapter {

    /**
     * Traits
     */
    use CallableTrait;

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
     * Set the sheet title
     * @param string $title
     * @return $this
     */
    abstract public function setTitle($title);
}