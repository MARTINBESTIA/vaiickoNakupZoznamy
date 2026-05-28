<?php

namespace App\Models;

use Framework\Core\Model;

class PolozkasInZoznam extends Model
{
    protected int $polozka_in_zoznam_id;
    protected int $polozka_id;
    protected int $zoznam_id;
    protected int $quantity;
    protected string $is_checked;

    protected static function getTableName(): string
    {
        return 'polozka_in_zoznam';
    }

    protected static function getPkColumnName(): string
    {
        return 'polozka_in_zoznam_id';
    }

    public function getPolozkaInZoznamId(): int
    {
        return $this->polozka_in_zoznam_id;
    }

    public function setPolozkaInZoznamId(int $polozka_in_zoznam_id): void
    {
        $this->polozka_in_zoznam_id = $polozka_in_zoznam_id;
    }

    public function getPolozkaId(): int
    {
        return $this->polozka_id;
    }

    public function setPolozkaId(int $polozka_id): void
    {
        $this->polozka_id = $polozka_id;
    }

    public function getZoznamId(): int
    {
        return $this->zoznam_id;
    }

    public function setZoznamId(int $zoznam_id): void
    {
        $this->zoznam_id = $zoznam_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getIsChecked(): string
    {
        return $this->is_checked;
    }

    public function setIsChecked(string $is_checked): void
    {
        $this->is_checked = $is_checked;
    }

}