<?php

namespace Maatwebsite\Clerk\Pdf\Adapters\Snappy;

use Maatwebsite\Clerk\Pdf\Page as PageInterface;
use Maatwebsite\Clerk\Pdf\Pages\Page as AbstractPage;

class Page extends AbstractPage implements PageInterface
{
    /**
     * @param                   $text
     */
    public function __construct($text = null)
    {
        if ($text) {
            $this->addText($text);
        }
    }
}
