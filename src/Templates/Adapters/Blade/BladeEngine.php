<?php namespace Maatwebsite\Clerk\Templates\Adapters\Blade;

use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;

class BladeEngine {

    /**
     * Array containg paths where to look for blade files
     * @var array
     */
    public $viewPaths;

    /**
     * Location where to store cached views
     * @var string
     */
    public $cachePath;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Factory
     */
    protected $instance;

    /**
     * Initialize class
     * @param array  $viewPaths
     * @param string $cachePath
     */
    function __construct($viewPaths = array(), $cachePath)
    {
        $this->files = new FileSystem;
        $this->viewPaths = (array) $viewPaths;
        $this->cachePath = $cachePath;
    }

    /**
     * Get the factory
     */
    public function getFactory()
    {
        $resolver = $this->getEngineResolver();

        $finder = new FileViewFinder(
            $this->files,
            $this->viewPaths
        );

        return new Factory(
            $resolver,
            $finder,
            new Dispatcher()
        );
    }

    /**
     * Register the engine resolver instance.
     *
     * @return void
     */
    public function getEngineResolver()
    {
        $resolver = new EngineResolver;

        // Add PhpEngine
        $resolver->register('php', function ()
        {
            return new PhpEngine;
        });

        // Add Blade compiler engine
        $resolver->register('blade', function ()
        {
            return new CompilerEngine(
                new BladeCompiler(
                    $this->files,
                    $this->cachePath
                ),
                $this->files
            );
        });

        return $resolver;
    }
}