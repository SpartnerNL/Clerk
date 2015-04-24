<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Elements;

use DOMNode;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;

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
        foreach ($node->attributes as $attribute) {
            if ($attribute->name == 'href') {
                $this->sheet->getDriver()->getCell($table->getCoordinate())
                            ->getHyperlink()
                            ->setUrl($attribute->value);

                // Underline and make it blue
                $this->sheet->cell($table->getCoordinate(), function ($cell) {
                    $cell->font()->underline()->color('0000ff');
                });
            }
        }

        // Add whitespace
        $table->appendContent(' ');

        $this->next($node, $table);
    }
}
