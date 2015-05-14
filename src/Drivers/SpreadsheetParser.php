<?php

namespace Maatwebsite\Clerk\Drivers;

class SpreadsheetParser extends AbstractDriver implements DriverInterface
{
    /**
     * Supported file formats
     * @var array
     */
    protected $supports = [
        'reader' => [
            'excel2007' => true,
            'csv'       => true
        ],
        'writer' => [
            'excel2007' => true,
            'csv'       => true
        ]
    ];
}
