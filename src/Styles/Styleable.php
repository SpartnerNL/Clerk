<?php namespace Maatwebsite\Clerk\Styles;

use Closure;
use Maatwebsite\Clerk\Style;

interface Styleable {

    /**
     * @return bool
     */
    public function hasStyles();

    /**
     * @param Style $style
     * @return $this
     */
    public function setStyle(Style $style);

    /**
     * @return array
     */
    public function getStyles();

    /**
     * @param callable $callback
     * @return Font
     */
    public function font(Closure $callback = null);
}