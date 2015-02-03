<?php namespace Maatwebsite\Clerk\Excel\Styles;

use Maatwebsite\Clerk\Traits\CallableTrait;

class Borders implements Style {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var Border
     */
    protected $top;

    /**
     * @var Border
     */
    protected $bottom;

    /**
     * @var Border
     */
    protected $left;

    /**
     * @var Border
     */
    protected $right;

    /**
     * @param null $callback
     * @param null $style
     * @return Border
     */
    public function top($callback = null, $style = null)
    {
        $border = $this->makeBorder($callback, $style);

        return $this->top = $border;
    }

    /**
     * @return Border
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param null $callback
     * @param null $style
     * @return Border
     */
    public function bottom($callback = null, $style = null)
    {
        $border = $this->makeBorder($callback, $style);

        return $this->bottom = $border;
    }

    /**
     * @return Border
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * @param null $callback
     * @param null $style
     * @return Border
     */
    public function left($callback = null, $style = null)
    {
        $border = $this->makeBorder($callback, $style);

        return $this->left = $border;
    }

    /**
     * @return Border
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param null $callback
     * @param null $style
     * @return Border
     */
    public function right($callback = null, $style = null)
    {
        $border = $this->makeBorder($callback, $style);

        return $this->right = $border;
    }

    /**
     * @return Border
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @return array
     */
    public function getBorders()
    {
        return [
            'top'    => $this->top,
            'bottom' => $this->bottom,
            'left'   => $this->left,
            'right'  => $this->right,
        ];
    }

    /**
     * @param $callback
     * @param $style
     * @return Border
     */
    protected function makeBorder($callback, $style)
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

        return $border;
    }
}