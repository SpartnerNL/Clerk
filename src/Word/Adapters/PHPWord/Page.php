<?php

namespace Maatwebsite\Clerk\Word\Adapters\PHPWord;

use Maatwebsite\Clerk\Word\Page as PageInterface;
use Maatwebsite\Clerk\Word\Pages\Page as AbstractPage;

class Page extends AbstractPage implements PageInterface
{
    /**
     * @var WordPage
     */
    protected $driver;

    /**
     * @param   $text
     */
    public function __construct($text = null)
    {
        if ($text) {
            $this->addText($text);
        }
    }
}
