<?php

class ExcelTest extends \PHPUnit_Framework_TestCase
{
    use ExcelFileTestCase;

    protected $class = '\Maatwebsite\Clerk\Files\Excel';
    protected $ext   = 'xls';
}
