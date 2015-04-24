<?php

namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

/**
 * Class Csv.
 */
class Csv extends Excel
{
    /**
     * @var string
     */
    protected $extension = 'csv';

    /**
     * @var string
     */
    protected $format = 'CSV';

    /**
     * @return mixed
     */
    protected function getDriver()
    {
        return Ledger::get('drivers.csv', 'LeagueCsv');
    }
}
