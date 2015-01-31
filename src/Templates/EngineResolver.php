<?php namespace Maatwebsite\Clerk\Templates;

use Maatwebsite\Clerk\Ledger;

class EngineResolver {

    /**
     * @var array
     */
    protected $engines = [
        'blade'  => '.blade',
        'twig'   => '.html',
        'smarty' => '.tpl',
        'php'    => '.php'
    ];

    /**
     * @var string
     */
    protected $engine;

    /**
     * @var string
     */
    protected $file;

    /**
     * @param      string $file
     * @param string|null $engine
     */
    public function __construct($file, $engine = null)
    {
        // Check if the user has given a specific engine
        if ( !$engine || !$this->isRegisteredEngine($engine) )
        {
            $engine = $this->basedOnFileExtension($file);

            if ( !$engine )
            {
                $engine = $this->getDefaultEngine();
            }
        }

        $this->file = $file;
        $this->engine = $engine;
    }

    /**
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param string $engine
     * @return bool
     */
    protected function isRegisteredEngine($engine)
    {
        return in_array($engine, array_keys($this->engines));
    }

    /**
     * @param string $file
     * @return bool|int|string
     */
    protected function basedOnFileExtension($file)
    {
        foreach ($this->getEngines() as $engine => $extension)
        {
            if ( is_array($extension) )
            {
                foreach ($extension as $ext)
                {
                    if ( $this->checkExtension($file, $ext) )
                        return $engine;
                }
            }
            else
            {
                if ( $this->checkExtension($file, $extension) )
                    return $engine;
            }
        }

        return false;
    }

    /**
     * Check if the extension matches
     * @param $file
     * @param $extension
     * @return bool
     */
    protected function checkExtension($file, $extension)
    {
        return strpos($file, $extension) !== false;
    }

    /**
     * Get the default engine
     * @return mixed
     */
    protected function getDefaultEngine()
    {
        return Ledger::get('templates.default', 'php');
    }

    /**
     * @return array
     */
    protected function getEngines()
    {
        return Ledger::get('templates.engines', array(
            'blade'  => '.blade',
            'twig'   => '.html',
            'smarty' => '.tpl',
            'php'    => '.php'
        ));
    }
}