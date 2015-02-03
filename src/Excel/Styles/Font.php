<?php namespace Maatwebsite\Clerk\Excel\Styles;

use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Exceptions\InvalidArgumentException;

class Font implements Style {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var string
     */
    protected $name = 'Calibri';

    /**
     * @var int
     */
    protected $size = 11;

    /**
     * @var bool
     */
    protected $bold = false;

    /**
     * @var bool
     */
    protected $italic = false;

    /**
     * @var string
     */
    protected $color = '000000';

    /**
     * @var string
     */
    protected $underline = self::UNDERLINE_NONE;

    const UNDERLINE_NONE             = 'none';

    const UNDERLINE_DOUBLE           = 'double';

    const UNDERLINE_DOUBLEACCOUNTING = 'doubleAccounting';

    const UNDERLINE_SINGLE           = 'single';

    const UNDERLINE_SINGLEACCOUNTING = 'singleAccounting';


    /**
     * @param string $name
     * @return Font
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set size
     * @param int $size
     * @throws InvalidArgumentException
     * @return Font
     */
    public function size($size)
    {
        if ( false === filter_var($size, FILTER_VALIDATE_INT) )
            throw new InvalidArgumentException("The font size should be a numeric value");

        $this->size = $size;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param bool $state
     * @return Font If bold isn't boolean
     */
    public function bold($state = true)
    {
        if ( !is_bool($state) )
            throw new InvalidArgumentException("The parameter must be a boolean value");

        $this->bold = $state;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isBold()
    {
        return $this->bold;
    }

    /**
     * @param bool $state
     * @return Font
     */
    public function italic($state = true)
    {
        if ( !is_bool($state) )
            throw new InvalidArgumentException("The parameter must be a boolean value");

        $this->italic = $state;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isItalic()
    {
        return $this->italic;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function withColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $underline
     * @throws InvalidArgumentException
     * @return $this
     */
    public function underline($underline = self::UNDERLINE_SINGLE)
    {
        if ( !in_array($underline, $this->getUnderlines()) )
            throw new InvalidArgumentException("You should specifiy a valid underline value");

        $this->underline = $underline;

        return $this;
    }

    /**
     * Get underline
     *
     * @return string
     */
    public function getUnderline()
    {
        return $this->underline;
    }

    /**
     * Return the underline parameter list
     *
     * @return array
     */
    public function getUnderlines()
    {
        return [
            self::UNDERLINE_NONE,
            self::UNDERLINE_DOUBLE,
            self::UNDERLINE_DOUBLEACCOUNTING,
            self::UNDERLINE_SINGLE,
            self::UNDERLINE_SINGLEACCOUNTING,
        ];
    }
}