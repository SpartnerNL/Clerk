<?php

namespace Maatwebsite\Clerk\Pdf\Adapters\Snappy;

use Closure;
use Knp\Snappy\Pdf as Snappy;
use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Pdf\Document as DocumentInterface;
use Maatwebsite\Clerk\Pdf\Documents\Document as AbstractDocument;

class Document extends AbstractDocument implements DocumentInterface
{
    /*
    * @var Snappy
    */
    protected $driver;

    /**
     * @var array
     */
    protected $pages = [];

    /**
     * @param         $title
     * @param Closure $callback
     * @param Snappy  $driver
     */
    public function __construct($title, Closure $callback = null, Snappy $driver = null)
    {
        // Set Snappy instance
        $this->driver = $driver ?: new Snappy(
            Ledger::get('pdf.snappy.binary'),
            Ledger::get('pdf.snappy.options', [])
        );

        if ($timeout = Ledger::get('pdf.snappy.timeout', false)) {
            $this->driver->setTimeout($timeout);
        }

        parent::__construct($title, $callback);
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        //$this->getDriver()->getDocInfo()->setTitle($title);

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        //return $this->getDriver()->getDocInfo()->getTitle();
    }

    /**
     * Init a new page.
     *
     * @param         $text
     * @param Closure $callback
     *
     * @return Page
     */
    public function page($text = null, Closure $callback = null)
    {
        // Init a new page
        $page = new Page(
            !is_callable($text) ? $text : null,
            $this
        );

        // Preform callback on the page
        $page->call(
            !is_callable($text) ? $callback : $text
        );

        $this->addPage($page);

        return $page;
    }
}
