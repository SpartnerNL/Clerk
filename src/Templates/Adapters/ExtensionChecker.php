<?php namespace Maatwebsite\Clerk\Templates\Adapters;

trait ExtensionChecker {

    /**
     * Get file
     * @param $file
     * @return string|null
     */
    protected function getFile($file)
    {
        if ( $this->hasExtension($file) )
        {
            return $file;
        }
        else
        {
            // Append the extension
            return rtrim($file, '.') . '.' . $this->extension;
        }
    }

    /**
     * @param $file
     * @return bool
     */
    protected function hasExtension($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }
}