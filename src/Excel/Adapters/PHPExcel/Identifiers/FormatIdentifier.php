<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Identifiers;

use PHPExcel_IOFactory;

/**
 * Class FormatIdentifier.
 */
class FormatIdentifier
{
    /**
     * Available formats.
     *
     * @var array
     */
    protected $formats = [
        'Excel2007',
        'Excel5',
        'Excel2003XML',
        'OOCalc',
        'SYLK',
        'Gnumeric',
        'CSV',
        'HTML',
        'PDF',
    ];

    /**
     * Get the file format by file.
     *
     * @param string $file
     *
     * @throws LaravelExcelException
     *
     * @return string $format
     */
    public function getFormatByFile($file)
    {
        // get the file extension
        $ext = $this->getExtension($file);

        // get the file format
        $format = $this->getFormatByExtension($ext);

        // Check if the file can be read
        if ($this->canRead($format, $file)) {
            return $format;
        }

        // Do a last try to init the file with all available readers
        return $this->lastResort($file, $format, $ext);
    }

    /**
     * Identify file format.
     *
     * @param string $ext
     *
     * @return string $format
     */
    public function getFormatByExtension($ext)
    {
        switch ($ext) {
            /*
            |--------------------------------------------------------------------------
            | Excel 2007
            |--------------------------------------------------------------------------
            */
            case 'xlsx':
            case 'xlsm':
            case 'xltx':
            case 'xltm':
                return 'Excel2007';
            /*
            |--------------------------------------------------------------------------
            | Excel5
            |--------------------------------------------------------------------------
            */
            case 'xls':
            case 'xlt':
                return 'Excel5';
            /*
            |--------------------------------------------------------------------------
            | OOCalc
            |--------------------------------------------------------------------------
            */
            case 'ods':
            case 'ots':
                return 'OOCalc';
            /*
            |--------------------------------------------------------------------------
            | SYLK
            |--------------------------------------------------------------------------
            */
            case 'slk':
                return 'SYLK';
            /*
            |--------------------------------------------------------------------------
            | Excel2003XML
            |--------------------------------------------------------------------------
            */
            case 'xml':
                return 'Excel2003XML';
            /*
            |--------------------------------------------------------------------------
            | Gnumeric
            |--------------------------------------------------------------------------
            */
            case 'gnumeric':
                return 'Gnumeric';
            /*
            |--------------------------------------------------------------------------
            | HTML
            |--------------------------------------------------------------------------
            */
            case 'htm':
            case 'html':
                return 'HTML';
            /*
            |--------------------------------------------------------------------------
            | CSV
            |--------------------------------------------------------------------------
            */
            case 'csv':
            case 'txt':
                return 'CSV';
            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            */
            case 'pdf':
                return 'PDF';
        }
    }

    /**
     * Get the content type by file format.
     *
     * @param string $format
     *
     * @return string $contentType
     */
    public function getContentTypeByFormat($format)
    {
        switch ($format) {
            /*
            |--------------------------------------------------------------------------
            | Excel 2007
            |--------------------------------------------------------------------------
            */
            case 'Excel2007':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8';
            /*
            |--------------------------------------------------------------------------
            | Excel5
            |--------------------------------------------------------------------------
            */
            case 'Excel5':
                return 'application/vnd.ms-excel; charset=UTF-8';
            /*
            |--------------------------------------------------------------------------
            | HTML
            |--------------------------------------------------------------------------
            */
            case 'HTML':
                return 'HTML';
            /*
            |--------------------------------------------------------------------------
            | CSV
            |--------------------------------------------------------------------------
            */
            case 'CSV':
                return 'application/csv; charset=UTF-8';
            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            */
            case 'PDF':
                return 'application/pdf; charset=UTF-8';
        }
    }

    /**
     * Try every reader we have.
     *
     * @param string           $file
     * @param bool|null|string $wrongFormat
     * @param string           $ext
     *
     * @throws LaravelExcelException
     * @return string
     */
    protected function lastResort($file, $wrongFormat = false, $ext = 'xls')
    {
        // Loop through all available formats
        foreach ($this->formats as $format) {
            // Check if the file could be read
            if ($wrongFormat != $format && $this->canRead($format, $file)) {
                return $format;
            }
        }
        // Give up searching and throw an exception
        throw new LaravelExcelException('[ERROR] Reader could not identify file format for file [' . $file . '] with extension [' . $ext . ']');
    }

    /**
     * Check if we can read the file.
     *
     * @param string $format
     * @param string $file
     *
     * @return bool
     */
    protected function canRead($format, $file)
    {
        if ($format) {
            $reader = $this->initReader($format);

            return $reader && $reader->canRead($file);
        }

        return false;
    }

    /**
     * Init the reader based on the format.
     *
     * @param string $format
     *
     * @return \PHPExcel_Reader_IReader
     */
    protected function initReader($format)
    {
        return PHPExcel_IOFactory::createReader($format);
    }

    /**
     * Get the file extension.
     *
     * @param string $file
     *
     * @return string
     */
    protected function getExtension($file)
    {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }
}
