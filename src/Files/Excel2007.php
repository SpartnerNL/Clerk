<?php

namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

/**
 * Class Excel2007.
 */
class Excel2007 extends Excel
{
    /**
     * @var string
     */
    protected $extension = 'xlsx';

    /**
     * @var string
     */
    protected $format = 'Excel2007';

    /**
     * Get the driver.
     *
     * @param $type
     *
     * @return mixed
     */
    protected function getDriver($type)
    {
        return Ledger::get('drivers.' . $type . '.excel2007', 'PHPExcel');
    }
}
