<?php

namespace Maatwebsite\Clerk\Templates\Adapters\Smarty;

use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Templates\Adapters\ExtensionChecker;
use Maatwebsite\Clerk\Templates\Factory;
use Smarty;

class SmartyFactory implements Factory
{
    /*
     * Traits
     */
    use ExtensionChecker;

    /**
     * @var Smarty
     */
    protected $smarty;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $extension = 'tpl';

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(Ledger::get('templates.path'));
        $this->smarty->setCompileDir(Ledger::get('templates.compile'));
        $this->smarty->setCacheDir(Ledger::get('templates.cache'));
        $this->smarty->setConfigDir(Ledger::get('templates.config'));
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
        $this->file = $file;

        // Assign data
        $this->smarty->assign($data);

        return $this;
    }

    /**
     * Render the template.
     *
     * @return string
     */
    public function render()
    {
        return $this->smarty->fetch(
            $this->getFile($this->file)
        );
    }
}
