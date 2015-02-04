<?php namespace Maatwebsite\Clerk\Writers;

abstract class Writer {

    /**
     * @var Exportable
     */
    protected $exportable;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param                   $type
     * @param                   $extension
     * @param Exportable        $exportable
     */
    public function __construct($type, $extension, Exportable $exportable)
    {
        $this->extension = $extension;
        $this->type = $type;
        $this->exportable = $exportable;
    }

    /**
     * @param null $filename
     * @return mixed
     */
    abstract public function export($filename = null);

    /**
     * @return Exportable
     */
    public function getExportable()
    {
        return $this->exportable;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->getExportable()->getTitle();
    }

    /**
     * @param string|null $filename
     * @return string
     */
    protected function getFilename($filename = null)
    {
        if ( !$filename )
            return $this->getTitle();

        // Strip of file extensions
        if ( strpos($filename, '.') !== false )
        {
            return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        }

        return $filename;
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