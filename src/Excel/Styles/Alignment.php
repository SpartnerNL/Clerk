<?php

namespace Maatwebsite\Clerk\Excel\Styles;

use Maatwebsite\Clerk\Exceptions\InvalidArgumentException;
use Maatwebsite\Clerk\Traits\CallableTrait;

class Alignment implements Style
{
    /*
     * Traits
     */
    use CallableTrait;

    /**
     * @var string
     */
    protected $vertical = self::VERTICAL_BOTTOM;

    /**
     * @var string
     */
    protected $horizontal = self::HORIZONTAL_GENERAL;

    /**
     * @var bool
     */
    protected $wrapText = false;

    /**
     * @var int
     */
    protected $textIndent;

    const HORIZONTAL_GENERAL           = 'general';

    const HORIZONTAL_LEFT              = 'left';

    const HORIZONTAL_RIGHT             = 'right';

    const HORIZONTAL_CENTER            = 'center';

    const HORIZONTAL_CENTER_CONTINUOUS = 'centerContinuous';

    const HORIZONTAL_JUSTIFY           = 'justify';

    const VERTICAL_BOTTOM              = 'bottom';

    const VERTICAL_TOP                 = 'top';

    const VERTICAL_CENTER              = 'center';

    const VERTICAL_JUSTIFY             = 'justify';

    /**
     * @param string $alignment
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function horizontal($alignment)
    {
        if (!in_array($alignment, $this->getHorizontals())) {
            throw new InvalidArgumentException("[{$alignment}] is not a valid horizontal parameter");
        }

        $this->horizontal = $alignment;

        return $this;
    }

    /**
     * @return string
     */
    public function getHorizontal()
    {
        return $this->horizontal;
    }

    /**
     * @param string $alignment
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function vertical($alignment)
    {
        if (!in_array($alignment, $this->getVerticals())) {
            throw new InvalidArgumentException("[{$alignment}] is not a valid vertical parameter");
        }

        $this->vertical = $alignment;

        return $this;
    }

    /**
     * Get vertical alignment.
     *
     * @return string
     */
    public function getVertical()
    {
        return $this->vertical;
    }

    /**
     * @param bool $state
     *
     * @return $this
     */
    public function wrap($state = true)
    {
        $this->wrapText = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function getWrapText()
    {
        return $this->wrapText;
    }

    /**
     * @param int $indent
     *
     * @return $this
     */
    public function indent($indent)
    {
        $this->textIndent = str_replace('px', '', $indent);

        return $this;
    }

    /**
     * @return int
     */
    public function getTextIndent()
    {
        return $this->textIndent;
    }

    /**
     * @return string[]
     */
    public function getHorizontals()
    {
        return [
            self::HORIZONTAL_GENERAL,
            self::HORIZONTAL_LEFT,
            self::HORIZONTAL_RIGHT,
            self::HORIZONTAL_CENTER,
            self::HORIZONTAL_CENTER_CONTINUOUS,
            self::HORIZONTAL_JUSTIFY,
        ];
    }

    /**
     * @return string[]
     */
    public function getVerticals()
    {
        return [
            self::VERTICAL_BOTTOM,
            self::VERTICAL_TOP,
            self::VERTICAL_CENTER,
            self::VERTICAL_JUSTIFY,
        ];
    }
}
