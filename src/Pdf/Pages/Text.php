<?php namespace Maatwebsite\Clerk\Pdf\Pages;

use Maatwebsite\Clerk\Traits\CallableTrait;

class Text
{

    use CallableTrait;

    /**
     * @var string
     */
    protected $text;

    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
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
}
