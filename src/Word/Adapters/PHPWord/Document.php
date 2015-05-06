<?php

namespace Maatwebsite\Clerk\Word\Adapters\PHPWord;

use Closure;
use Maatwebsite\Clerk\Word\Document as DocumentInterface;
use Maatwebsite\Clerk\Word\Documents\Document as AbstractDocument;
use PhpOffice\PhpWord\PhpWord;

class Document extends AbstractDocument implements DocumentInterface
{

    /*
    * @var PHPWord
    */
    protected $driver;

    /**
     * @param         $title
     * @param Closure $callback
     * @param PhpWord $driver
     */
    public function __construct($title, Closure $callback = null, PHPWord $driver = null)
    {
        // Set PHPWord instance
        $this->driver = $driver ?: new PHPWord();

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
        $this->getDriver()->getDocInfo()->setTitle($title);

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getDriver()->getDocInfo()->getTitle();
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

        return $page;
    }
}
