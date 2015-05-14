<?php

namespace Maatwebsite\Clerk\Drivers;

class Snappy extends AbstractDriver implements DriverInterface
{
    /**
     * Supported file formats
     * @var array
     */
    protected $supports = [
        'writer' => [
            'pdf' => true
        ]
    ];
}
