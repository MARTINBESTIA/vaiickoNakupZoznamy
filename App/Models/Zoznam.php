<?php

namespace App\Models;

use Framework\Core\Model;

class Zoznam extends Model
{
    protected ?int $id;
    protected ?string $name ;

    protected static function getTableName(): string
    {
        return 'zoznam';
    }

    protected static function getPkColumnName(): string
    {
        return 'id';
    }

}