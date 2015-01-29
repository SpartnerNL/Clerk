<?php namespace Maatwebsite\Clerk\Adapters;

abstract class Writer {

    /**
     * @param null $filename
     * @return mixed
     */
    abstract public function export($filename = null);

    /**
     * @param $filename
     * @return mixed
     */
    protected function getFilename($filename = null)
    {
        if ( !$filename )
            return $this->workbook->getTitle();

        // Strip of file extensions
        if ( strpos($filename, '.') !== false )
        {
            return $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        }

        return $filename;
    }

    /**
     * @param $type
     * @return string
     */
    public function getContentType($type)
    {
        switch ($type)
        {
            /*
            |--------------------------------------------------------------------------
            | Excel 2007
            |--------------------------------------------------------------------------
            */
            case 'Excel2007':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8';
                break;
            /*
            |--------------------------------------------------------------------------
            | Excel5
            |--------------------------------------------------------------------------
            */
            case 'Excel5':
                return 'application/vnd.ms-excel; charset=UTF-8';
                break;
            /*
            |--------------------------------------------------------------------------
            | HTML
            |--------------------------------------------------------------------------
            */
            case 'HTML':
                return 'HTML';
                break;
            /*
            |--------------------------------------------------------------------------
            | CSV
            |--------------------------------------------------------------------------
            */
            case 'CSV':
                return 'application/csv; charset=UTF-8';
                break;
            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            */
            case 'PDF':
                return 'application/pdf; charset=UTF-8';
                break;
        }
    }

    /**
     * @param $headers
     * @throws \Exception
     */
    protected function sendHeaders($headers)
    {
        if ( headers_sent() ) throw new \Exception('Headers already sent');

        foreach ($headers as $header => $value)
        {
            header($header . ': ' . $value);
        }
    }
}