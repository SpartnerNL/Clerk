<?php namespace Maatwebsite\Clerk\Templates;

use Maatwebsite\Clerk\Exceptions\DriverNotFoundException;
use Maatwebsite\Clerk\Templates\EngineResolver;

class TemplateFactory {

    /**
     * @param string      $template
     * @param string|null $engine
     * @return mixed
     * @throws DriverNotFoundException
     */
    public static function create($template, $engine = null)
    {
        // Resolve the engine
        $engine = (new EngineResolver($template, $engine))->getEngine();

        // Get factory class
        $class = self::getFactoryClass($engine);

        if ( class_exists($class) )
            return new $class();

        throw new DriverNotFoundException("Template factory [{$engine}] was not found");
    }

    /**
     * @param string $engine
     * @return string
     */
    protected static function getFactoryClass($engine)
    {
        return 'Maatwebsite\\Clerk\\Templates\\Adapters\\' . ucfirst($engine) . '\\' . ucfirst($engine) . 'Factory';
    }
}