<?php namespace Maatwebsite\Clerk\Templates\Adapters\Php;

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Factory;

class PhpFactory implements Factory {

    /**
     * @var string
     */
    protected $extension = 'php';

    /**
     * Make the view
     * @param string $file
     * @param array  $data
     * @return $this
     */
    public function make($file, array $data = array())
    {
        // Find the template file
        $finder = new FileFinder(
            Ledger::get('templates.path'),
            $this->extension
        );

        // Compile the template with the PhpEngine
        $this->results = (new PhpEngine($finder))->compile($file, $data);

        return $this;
    }

    /**
     * Render the template
     * @return string
     */
    public function render()
    {
        return $this->results;
    }
}