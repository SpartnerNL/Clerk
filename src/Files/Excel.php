<?php namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

/**
 * Class Excel
 * @package Maatwebsite\Clerk\Files
 */
class Excel extends File {

    /**
     * @var string
     */
    protected $extension = 'xls';

    /**
     * @var string
     */
    protected $type = 'Excel5';

    /**
     * Get the driver
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.excel2003', 'PHPExcel');
    }
}