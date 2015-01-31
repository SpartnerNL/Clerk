<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements;

use DOMNode;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

class TableElement extends Element {

    /**
     * @param DOMNode        $node
     * @param ReferenceTable $table
     * @return mixed|void
     */
    public function parse(DOMNode $node, ReferenceTable &$table)
    {
        // Flush the table
        $this->flush($table);

        // Set column before processing table
        $table->setColumn(
            $table->setStartColumn()
        );

        if ( $table->getLevel() > 1 )
            $table->previousRow();

        // Parse next node
        $this->next($node, $table);

        // Set column after process the entire table
        $table->setColumn(
            $table->releaseStartColumn()
        );

        if ( $table->getLevel() > 1 )
        {
            $table->nextColumn();
        }
        else
        {
            $table->nextRow();
        }
    }
}