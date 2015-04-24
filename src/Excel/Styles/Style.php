<?php

namespace Maatwebsite\Clerk\Excel\Styles;

use Closure;

interface Style
{
    /**
     * Preform a callback on this workbook instance.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function call(Closure $callback = null);
}
