<?php namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

class Excel2007 extends File {

    /**
     * @var string
     */
    protected $extension = 'xlsx';

    /**
     * @var string
     */
    protected $type = 'Excel2007';

    /**
     * Get the driver
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.excel2007', 'PHPExcel');
    }
}