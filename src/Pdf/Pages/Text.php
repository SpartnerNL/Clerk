<?php

namespace Maatwebsite\Clerk\Pdf\Pages;

use Maatwebsite\Clerk\Traits\CallableTrait;

class Text
{
    use CallableTrait;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $alignment;

    /**
     * @param string $text
     * @param string $alignment
     */
    public function __construct($text, $alignment = 'right')
    {
        $this->text      = $text;
        $this->alignment = $alignment;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * @param string $alignment
     */
    public function setAlignment($alignment)
    {
        $this->alignment = $alignment;
    }
}
