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

        if ($page->getHeaders()) {
            foreach ($page->getHeaders() as $header) {
                if ($header->getRawText() instanceof PreserveText) {
                    $section->addHeader()->addPreserveText(
                        $header->getText(),
                        $header->getRawText()->getStyleFont(),
                        $header->getRawText()->getStyleParagraph()
                    );
                } else {
                    $section->addHeader()->addText($header->getText());
                }
            }
        }

        if ($page->getFooters()) {
            foreach ($page->getFooters() as $footer) {
                if ($footer->getRawText() instanceof PreserveText) {
                    $section->addFooter()->addPreserveText(
                        $footer->getText(),
                        $footer->getRawText()->getStyleFont(),
                        $footer->getRawText()->getStyleParagraph()
                    );
                } else {
                    $section->addFooter()->addText(
                        $footer->getText(),
                        $footer->getRawText()->getStyleFont(),
                        $footer->getRawText()->getStyleParagraph()
                    );
                }
            }
        }

        return $section;
    }
}
