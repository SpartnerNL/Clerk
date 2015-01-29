<?php

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

new Reader('test.csv', function ($reader)
{
});

new CsvReader('test.csv');