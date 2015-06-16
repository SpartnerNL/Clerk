<?php

namespace Maatwebsite\Clerk\Word\Adapters\PHPWord\Writers;

use Maatwebsite\Clerk\Word\Page;
use Maatwebsite\Clerk\Word\Pages\HtmlText;
use Maatwebsite\Clerk\Word\Pages\PreserveText;
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
            if ($page->getHeader()->getRawText() instanceof PreserveText) {
                $section->addHeader()->addPreserveText(
                    $page->getHeader()->getText(),
                    $page->getHeader()->getRawText()->getStyleFont(),
                    $page->getHeader()->getRawText()->getStyleParagraph()
                );
            } else {
                $section->addHeader()->addText($page->getHeader()->getText());
            }
        }

        if ($page->getFooter()) {
            if ($page->getFooter()->getRawText() instanceof PreserveText) {
                $section->addFooter()->addPreserveText(
                    $page->getFooter()->getText(),
                    $page->getFooter()->getRawText()->getStyleFont(),
                    $page->getFooter()->getRawText()->getStyleParagraph()
                );
            } else {
                $section->addFooter()->addText($page->getFooter()->getText());
            }
        }

        return $section;
    }
}
