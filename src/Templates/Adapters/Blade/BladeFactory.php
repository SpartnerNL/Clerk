<?php

namespace Maatwebsite\Clerk\Templates\Adapters\Blade;

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Factory;

class BladeFactory implements Factory
{
    /**
     * @var \Illuminate\View\Factory
     */
    protected $factory;

    /**
     * @var \Illuminate\View\View
     */
    protected $view;

    /**
     * @var array
     */
    protected $extensions = 'blade';

    /**
     * @throws DriverNotFoundException
     */
    public function __construct()
    {
        $this->factory = $this->resolveFactory();
    }

    /**
     * Make the view.
     *
     * @param       $file
     * @param array $data
     *
     * @return $this
     */
    public function make($file, array $data = [])
    {
        $this->view = $this->factory->make(
            $this->getFile($file),
            $data
        );

        return $this;
    }

    /**
     * Render the template.
     *
     * @return string
     */
    public function render()
    {
        return $this->view->render();
    }

    /**
     * Get the template file.
     *
     * @param string $file
     *
     * @return string
     */
    protected function getFile($file)
    {
        // Get file extension
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        // Remove all file extension information
        $file = str_replace([$this->extensions, $extension, '..'], '', $file);
        $file = ltrim($file, '.');
        $file = rtrim($file, '.');

        return $file;
    }

    /**
     * Resolve the factory.
     *
     * @return mixed
     */
    protected function resolveFactory()
    {
        // Mostly when using the blade factory Laravel is used,
        // so we can try to get the Laravel View factory from the ioC container
        if (function_exists('app') && method_exists(app(), 'bound') && app()->bound('view')) {
            return app('view');
        }

        // Resolve the View factor
        return (new BladeEngine(
            Ledger::get('templates.path'),
            Ledger::get('templates.cache')
        ))->getFactory();
    }
}
