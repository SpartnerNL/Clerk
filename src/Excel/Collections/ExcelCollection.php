<?php

namespace Maatwebsite\Clerk\Excel\Collections;

use Illuminate\Support\Collection;

/**
 * Class ExcelCollection.
 */
class ExcelCollection extends Collection
{
    /**
     * Sheet title.
     *
     * @var string
     */
    protected $title;

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title.
     *
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
