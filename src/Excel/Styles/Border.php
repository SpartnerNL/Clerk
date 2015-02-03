<?php namespace Maatwebsite\Clerk\Excel\Styles;

use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Exceptions\InvalidArgumentException;

class Border implements Style {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var string
     */
    protected $color = '000000';

    /**
     * @var string
     */
    protected $style = self::BORDER_THIN;

    const BORDER_NONE             = 'none';

    const BORDER_DASHDOT          = 'dashDot';

    const BORDER_DASHDOTDOT       = 'dashDotDot';

    const BORDER_DASHED           = 'dashed';

    const BORDER_DOTTED           = 'dotted';

    const BORDER_DOUBLE           = 'double';

    const BORDER_HAIR             = 'hair';

    const BORDER_MEDIUM           = 'medium';

    const BORDER_MEDIUMDASHDOT    = 'mediumDashDot';

    const BORDER_MEDIUMDASHDOTDOT = 'mediumDashDotDot';

    const BORDER_MEDIUMDASHED     = 'mediumDashed';

    const BORDER_SLANTDASHDOT     = 'slantDashDot';

    const BORDER_THICK            = 'thick';

    const BORDER_THIN             = 'thin';

    /**
     * @throws InvalidArgumentException
     * @param string $style
     * @return $this
     */
    public function setStyle($style)
    {
        if ( !in_array($style, $this->getStyles()) )
            throw new InvalidArgumentException("The parameter must belong to the Style parameter list");

        $this->style = $style;

        return $this;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function setColor($color)
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
     * @return array
     */
    public function getStyles()
    {
        return [
            self::BORDER_NONE,
            self::BORDER_DASHDOT,
            self::BORDER_DASHDOTDOT,
            self::BORDER_DASHED,
            self::BORDER_DOTTED,
            self::BORDER_DOUBLE,
            self::BORDER_HAIR,
            self::BORDER_MEDIUM,
            self::BORDER_MEDIUMDASHDOT,
            self::BORDER_MEDIUMDASHDOTDOT,
            self::BORDER_MEDIUMDASHED,
            self::BORDER_SLANTDASHDOT,
            self::BORDER_THICK,
            self::BORDER_THIN,
        ];
    }
}