<?php namespace Maatwebsite\Clerk\Word\Documents;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Document extends Adapter {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var array
     */
    protected $sections = array();

    /**
     * @param          $title
     * @param Closure  $callback
     */
    public function __construct($title, Closure $callback = null)
    {
        // Set workbook title
        $this->setTitle($title);

        // Make a callback on the workbook
        $this->call($callback);
    }

    /**
     * Set title
     * @param string $title
     * @return $this
     */
    public abstract function setTitle($title);
}