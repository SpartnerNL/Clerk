<?php

namespace Maatwebsite\Clerk;

use Closure;

class Clerk
{
    /**
     * @var File
     */
    protected $file;

    /**
     * @param         $type
     * @param         $name
     * @param Closure $closure
     *
     * @return Document
     */
    public function write($type, $name, Closure $closure = null)
    {
        return new Document($type, $name, $closure);
    }
}
