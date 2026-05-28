<?php

namespace App\Models;

use Framework\Core\Model;

class Zoznam extends Model
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $is_bought;
    protected ?int $creator_id;

    protected static function getTableName(): string
    {
        return 'zoznam';
    }

    protected static function getPkColumnName(): string
    {
        return 'id';
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIsBought(): ?string
    {
        return $this->is_bought;
    }

    public function setIsBought(?string $is_bought): void
    {
        $this->is_bought = $is_bought;
    }

    public function getCreatorId(): ?int
    {
        return $this->creator_id;
    }

    public function setCreatorId(?int $creator_id): void
    {
        $this->creator_id = $creator_id;
    }

}