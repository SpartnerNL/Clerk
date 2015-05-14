<?php

namespace Maatwebsite\Clerk\Drivers;

class LeagueCsv extends AbstractDriver implements DriverInterface
{
    /**
     * Supported file formats
     * @var array
     */
    protected $supports = [
        'reader' => [
            'csv' => true
        ],
        'writer' => [
            'csv' => true
        ]
    ];
}
