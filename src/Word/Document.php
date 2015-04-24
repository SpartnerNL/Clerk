<?php

namespace Maatwebsite\Clerk\Word;

use Maatwebsite\Clerk\Writers\Exportable;

interface Document extends Exportable
{
    public function save($file, $format = 'Excel2007', $download = true);
}
