<?php

namespace Maatwebsite\Clerk\Excel\Readers;

use Illuminate\Support\Str;

abstract class HeadingParser
{
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
     * Get index.
     *
     * @param  $cell
     *
     * @return string
     */
    protected function getIndex($cell)
    {
        // Get heading type
        $config = $this->settings->getHeadingType();

        // Get value
        $value = $this->getOriginalIndex($cell);

        switch ($config) {
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
     * Get slugged index.
     *
     * @param string $value
     * @param bool   $ascii
     *
     * @return string
     */
    protected function getSluggedIndex($value, $ascii = false)
    {
        // Get original
        $separator = $this->settings->getSeparator();

        // Convert to ascii when needed
        if ($ascii) {
            $value = $this->getAsciiIndex($value);
        }

        // Convert all dashes/underscores into separator
        $flip  = $separator == '-' ? '_' : '-';
        $value = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $value);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $value = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($value));

        // Replace all separator characters and whitespace by a single separator
        $value = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $value);

        return trim($value, $separator);
    }

    /**
     * Get ASCII index.
     *
     * @param string $value
     *
     * @return string
     */
    protected function getAsciiIndex($value)
    {
        return Str::ascii($value);
    }

    /**
     * Hahsed index.
     *
     * @param string $value
     *
     * @return string
     */
    protected function getHashedIndex($value)
    {
        return md5($value);
    }

    /**
     * Get translated index.
     *
     * @param string $value
     *
     * @return string
     */
    protected function getTranslatedIndex($value)
    {
        if (function_exists('trans')) {
            return trans($value);
        }
    }

    /**
     * Get original index.
     *
     * @param $cell
     *
     * @return string
     */
    abstract protected function getOriginalIndex($cell);
}
