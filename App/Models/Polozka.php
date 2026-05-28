<?php

namespace App\Models;

use Framework\Core\Model;

class Polozka extends Model
{
    protected ?int $id;
    protected ?string $name;
    protected ?int $amount;
    protected ?string $unit_type;
    protected ?string $image_path;
    protected ?float $price;

    /**
     * @return mixed
     */

    public static function getTableName(): string
    {
        return 'polozka';
    }

    protected static function getPkColumnName(): string
    {
        return 'id';
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */


    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param mixed $image_path
     */
    public function setImagePath($image_path): void
    {
        $this->image_path = $image_path;
    }

    public function getUnitType(): ?string
    {
        return $this->unit_type;
    }

    public function setUnitType(?string $unit_type): void
    {
        $this->unit_type = $unit_type;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }


}