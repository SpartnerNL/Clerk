<?php

namespace Maatwebsite\Clerk\Pdf\Documents;

use Maatwebsite\Clerk\Pdf\Pages\Text;
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
     * @return Text
     */
    public function getRawText()
    {
        return $this->text;
    }

    /**
     * @param Text $text
     */
    public function setText(Text $text)
    {
        $this->text = $text;
    }
}
