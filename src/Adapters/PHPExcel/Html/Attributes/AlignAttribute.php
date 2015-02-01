<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html\Attributes;

use DOMAttr;
use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

class AlignAttribute extends Attribute {

    /**
     * @param DOMAttr        $attribute
     * @param ReferenceTable $table
     * @return mixed
     */
    public function parse(DOMAttr $attribute, ReferenceTable &$table)
    {
        //$horizontal = false;
        //
        //$cells = $this->sheet->getDriver()->getStyle(
        //    $table->getColumn() . $table->getRow()
        //);
        //
        //switch ($attribute->value)
        //{
        //    case 'center':
        //        $horizontal = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
        //
        //    case 'left':
        //        $horizontal = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
        //
        //    case 'right':
        //        $horizontal = PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
        //
        //    case 'justify':
        //        $horizontal = PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY;
        //}
        //
        //if ( $horizontal )
        //    $cells->getAlignment()->applyFromArray(
        //        array('horizontal' => $horizontal)
        //    );
    }
}