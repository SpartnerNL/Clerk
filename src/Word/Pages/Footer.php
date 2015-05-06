<?php namespace Maatwebsite\Clerk\Word\Pages;

use Maatwebsite\Clerk\Traits\CallableTrait;

class Footer
{
    use CallableTrait;

    /**
     * @var Text
     */
    protected $text;

    /**
     * @param Text $text
     */
    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    /**
     * @return Text
     */
    public function getText()
    {
        return $this->text->getText();
    }

    /**
     * @param Text $text
     */
    public function setText(Text $text)
    {
        $this->text = $text;
    }
}
