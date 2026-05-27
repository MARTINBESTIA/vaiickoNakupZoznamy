<?php

namespace App\Models;

use Framework\Core\Model;

class ZoznamInGroup extends Model
{
    protected int $zoznam_in_group_id;
    protected int $zoznam_id;
    protected int $group_id;

    protected static function getTableName(): string
    {
        return 'zoznam_in_group';
    }

    protected static function getPkColumnName(): string
    {
        return 'zoznam_in_group_id';
    }

    public function getZoznamInGroupId(): int
    {
        return $this->zoznam_in_group_id;
    }

    public function setZoznamInGroupId(int $zoznam_in_group_id): void
    {
        $this->zoznam_in_group_id = $zoznam_in_group_id;
    }

    public function getZoznamId(): int
    {
        return $this->zoznam_id;
    }

    public function setZoznamId(int $zoznam_id): void
    {
        $this->zoznam_id = $zoznam_id;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): void
    {
        $this->group_id = $group_id;
    }

    public function getIsBought(): int
    {
        return $this->is_bought;
    }

    public function setIsBought(int $is_bought): void
    {
        $this->is_bought = $is_bought;
    }


}