<?php

namespace Maatwebsite\Clerk\Files;

use Maatwebsite\Clerk\Ledger;

/**
 * Class Excel.
 */
class Word2007 extends Word
{
    /**
     * @var string
     */
    protected $extension = 'docx';

    /**
     * @var string
     */
    protected $format = 'Word2007';

    /**
     * Get the driver.
     *
     * @param $type
     *
     * @return mixed
     */
    protected function getDriver($type)
    {
        return Ledger::get('drivers.' . $type . '.word2007', 'PHPWord');
    }
}
