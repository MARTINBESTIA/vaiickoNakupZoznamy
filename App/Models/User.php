<?php

namespace App\Models;

use Framework\Core\Model;
use Framework\Core\IIdentity;

class User extends Model implements IIdentity
{
    protected ?int $id;
    protected ?string $username;
    protected ?string $password;

    protected static function getTableName(): string
    {
        return 'users';
    }

    protected static function getPkColumnName(): string
    {
        return 'id';
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->username ?? '';
    }

}