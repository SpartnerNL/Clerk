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

            $wordHeader = $section->addHeader();

            $table = $wordHeader->addTable();
            $table->addRow();

            foreach ($page->getHeaders() as $header) {

                $cell = $table->addCell(9000 / count($page->getHeaders()));

                if ($header->getRawText() instanceof PreserveText) {
                    $cell->addHeader()->addPreserveText(
                        $header->getText(),
                        $header->getRawText()->getStyleFont(),
                        $header->getRawText()->getStyleParagraph()
                    );
                } else {
                    $cell->addHeader()->addText($header->getText());
                }
            }
        }

        if ($page->getFooters()) {

            $wordFooter = $section->addFooter();

            $table = $wordFooter->addTable();
            $table->addRow();

            foreach ($page->getFooters() as $footer) {

                $cell = $table->addCell(9000 / count($page->getFooters()));

                if ($footer->getRawText() instanceof PreserveText) {
                    $cell->addPreserveText(
                        $footer->getText(),
                        $footer->getRawText()->getStyleFont(),
                        $footer->getRawText()->getStyleParagraph()
                    );
                } else {
                    $cell->addText(
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
