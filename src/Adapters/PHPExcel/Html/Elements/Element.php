<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Elements;

use DOMNode;
use DOMElement;
use DOMTEXT;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\AttributeParserFactory;
use Maatwebsite\Clerk\Sheet;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ElementParserFactory;

abstract class Element {

    /**
     * @var Sheet
     */
    protected $sheet;

    /**
     * @param Sheet $sheet
     */
    public function __construct(Sheet &$sheet)
    {
        $this->sheet = $sheet;
    }

    /**
     * @param DOMNode        $element
     * @param ReferenceTable $table
     * @return mixed
     */
    abstract public function parse(DOMNode $element, ReferenceTable &$table);

    /**
     * @param DOMNode        $node
     * @param ReferenceTable $table
     */
    public function next(DOMNode $node, ReferenceTable &$table)
    {
        foreach ($node->childNodes as $child)
        {
            // Text value
            if ( $child instanceof DOMTEXT )
            {
                $table->appendContentByNode($child);
            }
            elseif ( $child instanceof DOMElement )
            {
                foreach ($child->attributes as $attribute)
                {
                    $parser = AttributeParserFactory::create($attribute->name, $this->sheet);

                    if ( $parser )
                        $parser->parse($attribute, $table);
                }

                // Get the element parser based on the node name
                $parser = ElementParserFactory::create($child->nodeName, $this->sheet);

                // It's possible a parser does not exist
                // That means it's probably not very interesting
                // to parse that element
                if ( $parser )
                {
                    $parser->parse($child, $table);
                }

                // But we will keep going through it's children
                else
                {
                    $this->next($child, $table);
                }
            }
        }
    }

    /**
     * @param ReferenceTable $table
     */
    public function flush(ReferenceTable &$table)
    {
        if ( is_string($table->getContent()) )
        {
            if ( trim($table->getContent()) > '' )
            {
                // Set cell value
                $this->sheet->setCellValue($table->getColumn() . $table->getRow(), $table->getContent(), true);
                $table->rememberData($table->getContent());
            }
        }
        else
        {
            $table->rememberData('RICH TEXT: ' . $table->getContent());
        }

        $table->setContent('');
    }
}