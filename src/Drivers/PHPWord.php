<?php

namespace Maatwebsite\Clerk\Drivers;

class PHPWord extends AbstractDriver implements DriverInterface
{
    /**
     * Supported file formats
     * @var array
     */
    protected $supports = [
        'reader' => [
            'word2003' => true,
            'word2007' => true
        ],
        'writer' => [
            'word2003' => true,
            'word2007' => true
        ]
    ];
}
