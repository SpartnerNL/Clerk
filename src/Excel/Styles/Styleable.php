<?php

namespace Maatwebsite\Clerk\Excel\Styles;

use Closure;

interface Styleable
{
    /**
     * @return bool
     */
    public function hasStyles();

    /**
     * @param Style $style
     *
     * @return $this
     */
    public function setStyle(Style $style);

    /**
     * @return array
     */
    public function getStyles();

    /**
     * @param callable $callback
     *
     * @return Font
     */
    public function font(Closure $callback = null);

    /**
     * @param string|callable $callback
     * @param string|null     $type
     *
     * @return Fill
     */
    public function fill($callback = null, $type = null);

    /**
     * @param string|callable $callback
     * @param string|null     $type
     *
     * @return Fill
     */
    public function background($callback = null, $type = null);

    /**
     * @param string|callable|null $callback
     * @param string|null          $style
     *
     * @return Border
     */
    public function border($callback = null, $style = null);

    /**
     * @param callable|null $callback
     *
     * @return Border
     */
    public function borders(Closure $callback = null);

    /**
     * @param string|callable|null $callback
     * @param string|null          $vertical
     *
     * @return Alignment
     */
    public function align($callback = null, $vertical = null);

    /**
     * @param $vertical
     *
     * @return mixed
     */
    public function valign($vertical);
}
