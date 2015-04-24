<?php

namespace Maatwebsite\Clerk\Excel\Styles;

use Closure;
use Maatwebsite\Clerk\Excel\Collections\StyleCollection;

trait StyleableTrait
{

    /**
     * @var StyleCollection
     */
    protected $styles;

    /**
     * @var Font
     */
    protected $font;

    /**
     * @var Fill
     */
    protected $fill;

    /**
     * @var Border
     */
    protected $border;

    /**
     * @var Borders
     */
    protected $borders;

    /**
     * @var Alignment
     */
    protected $alignment;

    /**
     * @var Alignment
     */
    protected $valignment;

    /**
     * @param Closure $callback
     *
     * @return Font
     */
    public function font(Closure $callback = null)
    {
        $font = $this->font ?: new Font();

        if (is_callable($callback)) {
            $font->call($callback);
        }

        $this->setStyle($font);

        return $this->font = $font;
    }

    /**
     * @param string|Closure $callback
     * @param string|null    $type
     *
     * @return Fill
     */
    public function background($callback = null, $type = null)
    {
        return $this->fill($callback, $type);
    }

    /**
     * @param string|Closure|null $callback
     * @param string|null         $type
     *
     * @return Fill
     */
    public function fill($callback = null, $type = null)
    {
        $fill = $this->fill ?: new Fill();

        if (is_callable($callback)) {
            $fill->call($callback);
        } elseif (!is_null($callback)) {
            $fill->with($callback);
        }

        if ($type) {
            $fill->setType($type);
        }

        $this->setStyle($fill);

        return $this->fill = $fill;
    }

    /**
     * @param string|Closure|null $callback
     * @param string|null         $style
     *
     * @return Border
     */
    public function border($callback = null, $style = null)
    {
        $border = $this->border ?: new Border();

        if (is_callable($callback)) {
            $border->call($callback);
        } elseif (!is_null($callback)) {
            $border->setColor($callback);
        }

        if ($style) {
            $border->setStyle($style);
        }

        $this->setStyle($border);

        return $this->border = $border;
    }

    /**
     * @param Closure|null $callback
     *
     * @return Borders
     */
    public function borders(Closure $callback = null)
    {
        $borders = $this->borders ?: new Borders();

        if (is_callable($callback)) {
            $borders->call($callback);
        }

        $this->setStyle($borders);

        return $this->borders = $borders;
    }

    /**
     * @param string|Closure $horizontal
     *
     * @return Alignment
     */
    public function align($horizontal)
    {
        $alignment = $this->alignment ?: new Alignment();

        if (is_callable($horizontal)) {
            $alignment->call($horizontal);
        } else {
            $alignment->horizontal($horizontal);
        }

        $this->setStyle($alignment);

        return $this->alignment = $alignment;
    }

    /**
     * @param string|Closure $vertical
     *
     * @return Alignment
     */
    public function valign($vertical)
    {
        $alignment = $this->valignment ?: new Alignment();

        if (is_callable($vertical)) {
            $alignment->call($vertical);
        } else {
            $alignment->vertical($vertical);
        }

        $this->setStyle($alignment);

        return $this->valignment = $alignment;
    }

    /**
     * @param Style $style
     *
     * @return $this
     */
    public function setStyle(Style $style)
    {
        if (!$this->styles instanceof StyleCollection) {
            $this->styles = new StyleCollection();
        }

        $this->styles->push($style);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasStyles()
    {
        return count($this->styles) > 0;
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        return $this->styles;
    }
}
