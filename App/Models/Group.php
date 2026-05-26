<?php

namespace App\Models;

use Framework\Core\Model;

class Group extends Model
{
    protected ?int $id;

    protected ?string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    protected static function getTableName(): string
    {
        return 'groups';
    }

    protected static function getPkColumnName(): string
    {
        return 'id';
    }

}