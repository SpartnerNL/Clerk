<?php namespace Maatwebsite\Clerk\Word\Adapters\PHPWord;

use Closure;
use PhpOffice\PhpWord\PhpWord;
use Maatwebsite\Clerk\Word\Document as DocumentInterface;
use Maatwebsite\Clerk\Word\Documents\Document as AbstractDocument;

class Document extends AbstractDocument implements DocumentInterface {

    /*
    * @var PHPWord
    */
    protected $driver;

    /**
     * @param          $title
     * @param Closure  $callback
     * @param PhpWord  $driver
     */
    public function __construct($title, Closure $callback = null, PHPWord $driver = null)
    {
        // Set PHPWord instance
        $this->driver = $driver ?: new PHPWord();

        parent::__construct($title, $callback);
    }

    /**
     * Set title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->getDriver()->getDocInfo()->setTitle($title);

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getDriver()->getDocInfo()->getTitle();
    }

    /**
     * Init a new section
     * @param          $text
     * @param Closure  $callback
     * @return Section
     */
    public function section($text, Closure $callback = null)
    {
        // Init a new section
        $section = new Section(
            $text,
            $this
        );

        // Preform callback on the section
        $section->call($callback);

        return $section;
    }

    public function save($file, $format = 'Excel2007', $download = true)
    {
        // TODO: Implement save() method.
    }
}
