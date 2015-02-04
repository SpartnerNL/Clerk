<?php namespace Maatwebsite\Clerk\Files;

use Closure;
use Maatwebsite\Clerk\Ledger;
use Maatwebsite\Clerk\Excel\Readers\ReaderFactory;
use Maatwebsite\Clerk\Excel\Writers\WriterFactory;
use Maatwebsite\Clerk\Excel\Workbooks\WorkbookFactory;

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