<?php

namespace Maatwebsite\Clerk\Excel\Html\Elements;

use DOMNode;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;

class AElement extends Element
{
    /**
     * @param DOMNode        $node
     * @param ReferenceTable $table
     *
     * @return mixed|void
     */
    public function parse(DOMNode $node, ReferenceTable & $table)
    {
        $this->sheet->getCell($table->getCoordinate())
                    ->getHyperlink()
                    ->setUrl($node->getAttribute('href'));

        // Underline and make it blue
        $this->sheet->cell($table->getCoordinate(), function ($cell) {
            $cell->font()->underline()->color('0000ff');
        });

        // Add whitespace
        $table->appendContent(' ');

        $this->next($node, $table);
    }
}
