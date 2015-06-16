<?php

namespace Maatwebsite\Clerk\Pdf\Pages;

use Closure;
use Maatwebsite\Clerk\Templates\TemplateFactory;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Page
{
    /*
     * Traits
     */
    use CallableTrait;

    /**
     * @var array|Text[]
     */
    protected $text = [];

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
     * @param          $text
     * @param callable $callback
     *
     * @return $this
     */
    public function addHtml($text, Closure $callback = null)
    {
        $text = new HtmlText($text);

        $text->call($callback);

        $this->text[] = $text;

        return $this;
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

        $this->addHtml($html);

        return $this;
    }

    /**
     * @return array|Text[]
     */
    public function getText()
    {
        return $this->text;
    }
}
