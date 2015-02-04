<?php namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

/**
 * Class Excel2007
 * @package Maatwebsite\Clerk\Files
 */
class Excel2007 extends Excel {

    /**
     * @var string
     */
    protected $extension = 'xlsx';

    /**
     * @var string
     */
    protected $format = 'Excel2007';

    /**
     * Get the driver
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.excel2007', 'PHPExcel');
    }
}