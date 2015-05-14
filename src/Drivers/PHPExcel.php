<?php namespace Maatwebsite\Clerk\Drivers;

class PHPExcel extends AbstractDriver implements DriverInterface
{

    /**
     * Supported file formats
     * @var array
     */
    protected $supports = [
        'reader' => [
            'excel2003' => true,
            'excel2007' => true,
            'csv'       => true
        ],
        'writer' => [
            'excel2003' => true,
            'excel2007' => true,
            'csv'       => true
        ]
    ];

}
