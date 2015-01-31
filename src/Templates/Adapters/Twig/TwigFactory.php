<?php namespace Maatwebsite\Clerk\Templates\Adapters\Twig;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Factory;
use Maatwebsite\Clerk\Templates\Adapters\ExtensionChecker;

class TwigFactory implements Factory {

    /**
     * Traits
     */
    use ExtensionChecker;

    /**
     * @var \Twig_TemplateInterface
     */
    protected $template;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var string
     */
    protected $extension = 'html';

    /**
     * Constructor
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(Ledger::get('templates.path'));
        $this->twig = new Twig_Environment($loader, array(
            'cache' => Ledger::get('templates.cache'),
        ));
    }

    /**
     * Make the view
     * @param string $file
     * @param array  $data
     * @return $this
     */
    public function make($file, array $data = array())
    {
        $this->template = $this->twig->loadTemplate($this->getFile($file));
        $this->data = $data;

        return $this;
    }

    /**
     * Render the template
     * @return string
     */
    public function render()
    {
        return $this->template->render($this->data);
    }
}