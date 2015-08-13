<?php

namespace Maatwebsite\Clerk\Word\Pages;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Templates\TemplateFactory;
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
    protected $headers = [];

    /**
     * @var Footer
     */
    protected $footers = [];

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
     * @param bool     $fullHtml
     *
     * @return $this
     */
    public function addHtml($text, Closure $callback = null, $fullHtml = false)
    {
        $text = new HtmlText($text, $fullHtml);

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

        // Remove doctype, so drivers like PHPWord don't run into problems
        $html = preg_replace("/<!DOCTYPE [^>]+>/", '', $html);

        $this->addHtml($html, null, true);

        return $this;
    }

    /**
     * @param         $header
     * @param Closure $callback
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
     * @param  Closure $callback
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
     * @param  string $numbering
     * @param  null   $styleFont
     * @param  null   $styleParagraph
     * @return $this
     */
    public function setFooterNumbering($numbering = '{PAGE}', $styleFont = null, $styleParagraph = null)
    {
        $this->footers[] = new Footer(
            new PreserveText($numbering, $styleFont, $styleParagraph)
        );

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
