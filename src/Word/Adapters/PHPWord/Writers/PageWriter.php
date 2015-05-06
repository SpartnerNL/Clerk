<?php namespace Maatwebsite\Clerk\Word\Adapters\PHPWord\Writers;

use Maatwebsite\Clerk\Word\Page;
use PhpOffice\PhpWord\Element\Section;

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
            $section->addText($text);
        }

        if ($page->getHeader()) {
            $section->addHeader()->addText($page->getHeader());
        }

        if ($page->getFooter()) {
            $section->addFooter()->addText($page->getFooter());
        }

        return $section;
    }
}
