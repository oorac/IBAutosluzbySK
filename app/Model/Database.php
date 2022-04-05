<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette;

class Database
{
    protected Explorer $database;

    use Nette\SmartObject;

    public function __construct(Explorer $database)
    {
        $this->database = $database;
    }
}