<?php namespace Maatwebsite\Clerk\Templates;

interface Factory {

    /**
     * Make the view
     * @param string      $file
     * @param array $data
     * @return $this
     */
    public function make($file, array $data = array());

    /**
     * Render the template
     * @return string
     */
    public function render();
}