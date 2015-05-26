<?php

namespace Maatwebsite\Clerk\Word\Adapters\PHPWord\Writers;

use Maatwebsite\Clerk\Word\Page;
use Maatwebsite\Clerk\Word\Pages\HtmlText;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Html;

class PageWriter
{
    /**
     * @param Section $section
     * @param Page    $page
     *
     * @return Section
     */
    public function write(Section $section, Page $page)
    {
        foreach ($page->getText() as $text) {
            if ($text instanceof HtmlText) {
                Html::addHtml($section, $text->getText(), $text->isFullHtml());
            } else {
                $section->addText($text->getText());
            }
        }

        if ($page->getHeader()) {
            $section->addHeader()->addText($page->getHeader()->getText());
        }

        if ($page->getFooter()) {
            $section->addFooter()->addText($page->getFooter()->getText());
        }

        return $section;
    }
}
