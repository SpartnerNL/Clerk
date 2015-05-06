<?php

namespace Maatwebsite\Clerk\Word\Adapters\PHPWord;

use Maatwebsite\Clerk\Word\Document as DocumentInterface;
use Maatwebsite\Clerk\Word\Page as PageInterface;
use Maatwebsite\Clerk\Word\Pages\Page as AbstractPage;
use PhpOffice\PhpWord\Element\Section;

class Page extends AbstractPage implements PageInterface
{

    /**
     * @var WordPage
     */
    protected $driver;

    /**
     * @param                   $text
     * @param DocumentInterface $document
     * @param Section           $driver
     */
    public function __construct($text = null, DocumentInterface $document, Section $driver = null)
    {
        $this->driver = $document->getDriver()->addSection();

        if ($text) {
            $this->addText($text);
        }
    }

    /**
     * @param $text
     *
     * @return $this
     */
    public function addText($text)
    {
        $this->getDriver()->addText(htmlspecialchars($text));

        return $this;
    }

    /**
     * @param $text
     */
    public function setHeader($text)
    {
        $this->getDriver()->addHeader()->addText(htmlspecialchars($text));
    }

    /**
     * @param $text
     */
    public function setFooter($text)
    {
        $this->getDriver()->addFooter()->addText(htmlspecialchars($text));
    }
}
