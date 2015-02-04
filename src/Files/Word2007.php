<?php namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

/**
 * Class Excel
 * @package Maatwebsite\Clerk\Files
 */
class Word2007 extends Word {

    /**
     * @var string
     */
    protected $extension = 'docx';

    /**
     * @var string
     */
    protected $format = 'Excel5';

    /**
     * Get the driver
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.word2007', 'PHPWord');
    }
}