<?php

namespace Maatwebsite\Clerk\Templates\Css;

use Maatwebsite\Clerk\Templates\Factory;

class CssFactoryDecorator implements Factory
{
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Make the view.
     *
     * @param string $file
     * @param array  $data
     *
     * @return $this
     */
    public function make($file, array $data = [])
    {
        return $this->factory->make($file, $data);
    }

    /**
     * Render the template.
     * @return string
     */
    public function render()
    {
        return (new CssInliner())->transformCssToInlineStyles(
            $this->factory->render()
        );
    }
}
