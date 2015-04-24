<?php

namespace Maatwebsite\Clerk\Word\Adapters\PHPWord;

use Maatwebsite\Clerk\Word\Document as DocumentInterface;
use Maatwebsite\Clerk\Word\Section as SectionInterface;
use Maatwebsite\Clerk\Word\Sections\Section as AbstractSection;
use PhpOffice\PhpWord\Element\Section as WordSection;

class Section extends AbstractSection implements SectionInterface
{
    /**
     * @var WordSection
     */
    protected $driver;

    /**
     * @param                   $text
     * @param DocumentInterface $document
     * @param WordSection       $driver
     */
    public function __construct($text, DocumentInterface $document, WordSection $driver = null)
    {
        $this->driver = $document->getDriver()->addSection();

        $this->addText($text);
    }

    /**
     * @param $text
     *
     * @return $this
     */
    public function addText($text)
    {
        $this->getDriver()->addText($text);

        return $this;
    }
}
