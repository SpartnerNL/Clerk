<?php namespace Maatwebsite\Clerk\Excel\Styles;

use Closure;
use Maatwebsite\Clerk\Excel\Collections\StyleCollection;

trait StyleableTrait {

    /**
     * @var StyleCollection
     */
    protected $styles;

    /**
     * @param callable $callback
     * @return Font
     */
    public function font(Closure $callback = null)
    {
        $font = new Font();

        if ( is_callable($callback) )
            $font->call($callback);

        $this->setStyle($font);

        return $font;
    }

    /**
     * @param string|callable $callback
     * @param string|null     $type
     * @return Fill
     */
    public function background($callback = null, $type = null)
    {
        return $this->fill($callback, $type);
    }

    /**
     * @param string|callable|null $callback
     * @param string|null          $type
     * @return Fill
     */
    public function fill($callback = null, $type = null)
    {
        $font = new Fill();

        if ( is_callable($callback) )
        {
            $font->call($callback);
        }
        elseif ( !is_null($callback) )
        {
            $font->with($callback);
        }

        if ( $type )
            $font->setType($type);

        $this->setStyle($font);

        return $font;
    }

    /**
     * @param string|callable|null $callback
     * @param string|null          $style
     * @return Border
     */
    public function border($callback = null, $style = null)
    {
        $border = new Border();

        if ( is_callable($callback) )
        {
            $border->call($callback);
        }
        elseif ( !is_null($callback) )
        {
            $border->setColor($callback);
        }

        if ( $style )
            $border->setStyle($style);

        $this->setStyle($border);

        return $border;
    }

    /**
     * @param callable|null $callback
     * @return Border
     */
    public function borders(Closure $callback = null)
    {
        $borders = new Borders();

        if ( is_callable($callback) )
            $borders->call($callback);

        $this->setStyle($borders);

        return $borders;
    }

    /**
     * @param string|callable|null $callback
     * @param string|null          $vertical
     * @return Alignment
     */
    public function align($callback = null, $vertical = null)
    {
        $alignment = new Alignment();

        if ( is_callable($callback) )
        {
            $alignment->call($callback);
        }
        elseif ( !is_null($callback) )
        {
            $alignment->horizontal($callback);
        }

        if ( $vertical )
            $alignment->vertical($vertical);

        $this->setStyle($alignment);

        return $alignment;
    }

    /**
     * @param $vertical
     * @return Alignment
     */
    public function valign($vertical)
    {
        return $this->align(null, $vertical);
    }

    /**
     * @param Style $style
     * @return $this
     */
    public function setStyle(Style $style)
    {
        if ( !$this->styles instanceof StyleCollection )
        {
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