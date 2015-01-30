<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Parsers;

use Illuminate\Support\Str;
use Maatwebsite\Clerk\Adapters\ParserSettings;

/**
 * Class HeadingParser
 * @package Maatwebsite\Clerk\Adapters\PHPExcel\Parsers
 */
class HeadingParser {

    /**
     * @var ParserSettings
     */
    protected $settings;

    /**
     * @param ParserSettings $settings
     */
    public function __construct(ParserSettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param \PHPExcel_Worksheet $sheet
     * @return array
     */
    public function parse(\PHPExcel_Worksheet $sheet)
    {
        return $this->settings->getHasHeading() ? $this->getHeading($sheet) : array();
    }

    /**
     * Get the heading
     * @param \PHPExcel_Worksheet $worksheet
     * @return array
     */
    protected function getHeading($worksheet)
    {
        // Fetch the first row
        $row = $worksheet->getRowIterator($this->settings->getHeadingRow())->current();

        // Set empty labels array
        $heading = array();

        // Loop through the cells
        foreach ($row->getCellIterator() as $cell)
        {
            $heading[] = $this->getIndex($cell);
        }

        return $heading;
    }


    /**
     * Get index
     * @param  $cell
     * @return string
     */
    protected function getIndex($cell)
    {
        // Get heading type
        $config = $this->settings->getHeadingType();

        // Get value
        $value = $this->getOriginalIndex($cell);

        switch ($config)
        {
            case 'slugged':
                return $this->getSluggedIndex($value, $this->settings->getAscii());

            case 'ascii':
                return $this->getAsciiIndex($value);

            case 'hashed':
                return $this->getHashedIndex($value);

            case 'trans':
                return $this->getTranslatedIndex($value);

            case 'original':
                return $value;
        }
    }

    /**
     * Get slugged index
     * @param  string $value
     * @param bool    $ascii
     * @return string
     */
    protected function getSluggedIndex($value, $ascii = false)
    {
        // Get original
        $separator = $this->settings->getSeparator();

        // Convert to ascii when needed
        if ( $ascii )
            $value = $this->getAsciiIndex($value);

        // Convert all dashes/underscores into separator
        $flip = $separator == '-' ? '_' : '-';
        $value = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $value);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $value = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($value));

        // Replace all separator characters and whitespace by a single separator
        $value = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $value);

        return trim($value, $separator);
    }

    /**
     * Get ASCII index
     * @param  string $value
     * @return string
     */
    protected function getAsciiIndex($value)
    {
        return Str::ascii($value);
    }

    /**
     * Hahsed index
     * @param  string $value
     * @return string
     */
    protected function getHashedIndex($value)
    {
        return md5($value);
    }

    /**
     * Get translated index
     * @param  string $value
     * @return string
     */
    protected function getTranslatedIndex($value)
    {
        if ( function_exists('trans') )
            return trans($value);
    }

    /**
     * Get orignal indice
     * @param $cell
     * @return string
     */
    protected function getOriginalIndex($cell)
    {
        return $cell->getValue();
    }
}