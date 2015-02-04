<?php namespace Maatwebsite\Clerk;

use Closure;
use Maatwebsite\Excel\Files\File;

class Document {

    /**
     * @var File
     */
    protected $file;

    /**
     * @param         $type
     * @param         $title
     * @param Closure $callback
     */
    public function __construct($type, $title, Closure $callback = null)
    {
        $this->file = DocumentFactory::create($type, $title, $callback);
    }

    /**
     * @return Files\File|File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $method
     * @param $params
     */
    public function __call($method, $params)
    {
        if ( method_exists($this->getFile(), $method) )
            call_user_func_array([$this->file, $method], $params);
    }
}