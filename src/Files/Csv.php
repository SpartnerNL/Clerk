<?php namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

/**
 * Class Csv
 * @package Maatwebsite\Clerk\Files
 */
class Csv extends File {

    /**
     * @var string
     */
    protected $extension = 'csv';

    /**
     * @var string
     */
    protected $type = 'CSV';

    /**
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.csv', 'LeagueCsv');
    }
}