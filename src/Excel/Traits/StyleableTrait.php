<?php namespace Maatwebsite\Clerk\Excel\Traits;

use Closure;
use Maatwebsite\Clerk\Excel\Styles\Font;
use Maatwebsite\Clerk\Excel\Styles\Style;
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