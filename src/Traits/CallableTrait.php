<?php

namespace Maatwebsite\Clerk\Traits;

use Closure;

/**
 * Class CallableTrait.
 */
trait CallableTrait
{
    /**
     * Preform a callback on this workbook instance.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function call(Closure $callback = null)
    {
        if (is_callable($callback)) {
            call_user_func($callback, $this);
        }

        return $this;
    }
}
