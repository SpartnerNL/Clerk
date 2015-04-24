<?php

namespace Maatwebsite\Clerk\Templates\Adapters\Php;

use Maatwebsite\Clerk\Exceptions\TemplateNotFoundException;
use Maatwebsite\Clerk\Templates\Adapters\ExtensionChecker;

/**
 * Class FileFinder.
 */
class FileFinder
{
    /*
     * Traits
     */
    use ExtensionChecker;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @param string $path
     * @param        $extension
     */
    public function __construct($path, $extension)
    {
        $this->path      = $path;
        $this->extension = $extension;
    }

    /**
     * Find the file.
     *
     * @param $file
     *
     * @throws TemplateNotFoundException
     * @return string
     */
    public function find($file)
    {
        $path = $this->path . '/' . $this->getFile($file);

        if (file_exists($path)) {
            return $path;
        }

        throw new TemplateNotFoundException("Template [{$file}] at path {$path} could not be found");
    }
}
