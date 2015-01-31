<?php namespace Maatwebsite\Clerk\Templates\Adapters\Php;
use Exception;

/**
 * Class PhpEngine
 * @package Maatwebsite\Clerk\Templates\Adapters\Php
 * Based on Laravel's PhpEngine
 */
class PhpEngine {

    /**
     * @var FileFinder
     */
    protected $finder;

    /**
     * @param FileFinder $finder
     */
    public function __construct(FileFinder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * Compile a template with the PhpEngine
     * @param  string $__file
     * @param  array  $__data
     * @return string
     */
    public function compile($__file, array $__data = array())
    {
        // Find the file path
        $__path = $this->finder->find($__file);

        $obLevel = ob_get_level();

        ob_start();

        extract($__data);

        // We'll evaluate the contents of the view inside a try/catch block so we can
        // flush out any stray output that might get out before an error occurs or
        // an exception is thrown. This prevents any partial views from leaking.
        try
        {
            include $__path;
        }
        catch (Exception $e)
        {
            $this->handleViewException($e, $obLevel);
        }

        return ltrim(ob_get_clean());
    }

    /**
     * Handle a view exception.
     *
     * @param  \Exception $e
     * @param  int        $obLevel
     * @return void
     *
     * @throws $e
     */
    protected function handleViewException($e, $obLevel)
    {
        while (ob_get_level() > $obLevel)
        {
            ob_end_clean();
        }

        throw $e;
    }
}