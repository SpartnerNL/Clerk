<?php

use Maatwebsite\Clerk\Reader;

$workbook = new Workbook('title');
$sheet = new Sheet($workbook, 'title');
$workbook->addSheet($sheet);

$writer = WriterFactory::create('PHPExcel', 'Excel5', 'xls', $workbook);
$writer->export($workbook);

///////

Excel::create('title', function ($workbook)
{
    /// $workbook = new Workbook('title');

    $workbook->sheet('title', function ($sheet)
    {
        /// $sheet = new Sheet('title');

        // Ends with $workbook->addSheet($sheet);
    });
});

/////

new Excel('title', function ($workbook)
{
    /// $workbook = new Workbook('title');

    $workbook->sheet('title', function ($sheet)
    {
        /// $sheet = new Sheet('title');

        // Ends with $workbook->addSheet($sheet);
    });
});

/////

Excel::load();
Csv::load();

//new Excel('test.csv', function (Reader $reader)
//{
//    $reader-
//});

//new CsvReader('test.csv');