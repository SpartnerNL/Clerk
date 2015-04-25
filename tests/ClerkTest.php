<?php

use Maatwebsite\Clerk\Clerk;

class ClerkTest extends \PHPUnit_Framework_TestCase
{
    public function test_writing_csv_file()
    {
        $clerk = new Clerk();
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Csv', $clerk->write('csv', 'name')->getFile());
    }
}
