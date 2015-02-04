<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Html\StyleParserFactory;

class StyleAttribute extends Attribute {

    /**
     * @var string
     */
    protected $styleSeparator = ';';

    /**
     * @var string
     */
    protected $valueSeperator = ':';

    /**
     * @param DOMAttr        $attribute
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(DOMAttr $attribute, ReferenceTable &$table)
    {
        // Get all inline styles separately
        $styles = explode($this->styleSeparator, $attribute->value);

        foreach ($styles as $style)
        {
            // Get style name and value
            try
            {
                list($style, $value) = explode($this->valueSeperator, $style);

                // When the parser exists, parse the style
                if ( $parser = StyleParserFactory::create($style, $this->sheet) )
                    $parser->parse($value, $table);
            }
            catch (\Exception $e)
            {
            }
        }
    }
}