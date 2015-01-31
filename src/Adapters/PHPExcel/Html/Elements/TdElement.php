<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements;

use DOMNode;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

class TdElement extends Element {

    /**
     * @param DOMNode        $node
     * @param ReferenceTable $table
     * @return mixed|void
     */
    public function parse(DOMNode $node, ReferenceTable &$table)
    {
        $this->next($node, $table);

        $this->flush($table);

        $table->nextColumn();
    }
}