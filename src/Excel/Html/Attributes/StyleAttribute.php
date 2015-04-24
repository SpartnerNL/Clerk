<?php

namespace Maatwebsite\Clerk\Excel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Excel\Html\ReferenceTable;
use Maatwebsite\Clerk\Excel\Html\StyleParserFactory;

class StyleAttribute extends Attribute
{
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
     *
     * @return mixed
     */
    public function parse(DOMAttr $attribute, ReferenceTable & $table)
    {
        // Get all inline styles separately
        $styles = explode($this->styleSeparator, $attribute->value);

        foreach ($styles as $style) {
            $style = explode($this->valueSeperator, $style);
            $name  = trim(reset($style));
            $value = trim(end($style));

            // When the parser exists, parse the style
            if ($name && $value && $parser = StyleParserFactory::create($name, $this->sheet)) {
                $cell = $this->sheet->cell($table->getCoordinate());
                $parser->parse($cell, $value, $table);
            }
        }
    }
}
