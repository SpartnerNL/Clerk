<?php

namespace Maatwebsite\Clerk\Excel\Sheets;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Excel\Html\HtmlToSheetConverter;
use Maatwebsite\Clerk\Excel\Styles\Styleable;
use Maatwebsite\Clerk\Excel\Styles\StyleableTrait;
use Maatwebsite\Clerk\Templates\TemplateFactory;
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
     * Load from template.
     *
     * @param       $template
     * @param array $data
     * @param null  $engine
     *
     * @return mixed
     */
    public function loadTemplate($template, array $data = [], $engine = null)
    {
        // Init factory based on given engine, based on extension or use of default engine
        $factory = TemplateFactory::create($template, $engine);

        // Render the template
        $html = $factory->make($template, $data)->render();

        // Convert the html to a sheet
        (new HtmlToSheetConverter())->convert(
            $html,
            $this
        );

        return $this;
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
