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
     * Get the driver.
     *
     * @param $type
     *
     * @return mixed
     */
    protected function getDriver($type)
    {
        return Ledger::resolve('drivers.' . $type . '.csv', 'LeagueCsv');
    }
}
