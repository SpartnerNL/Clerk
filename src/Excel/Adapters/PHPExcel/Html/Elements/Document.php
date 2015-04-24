<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Elements;

use DOMNode;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;

class Document extends Element
{
    /**
     * @param DOMNode        $node
     * @param ReferenceTable $table
     *
     * @return mixed
     */
    public function parse(DOMNode $node, ReferenceTable & $table)
    {
        $this->next($node, $table);
    }
}
