<?php

namespace Maatwebsite\Clerk\Word\Sections;

use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Section extends Adapter
{
    /*
     * Traits
     */
    use CallableTrait;

    /**
     * @var mixed
     */
    protected $driver;
}
