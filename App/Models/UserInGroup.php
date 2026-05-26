<?php

namespace App\Models;

use Framework\Core\Model;

class UserInGroup extends Model
{
    protected int $user_in_group_id ;
    protected int $user_id;
    protected int $group_id;


    protected static function getTableName(): string
    {
        return 'user_in_group';
    }

    protected static function getPkColumnName(): string
    {
        return 'user_in_group_id';
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): void
    {
        $this->group_id = $group_id;
    }

    public function getUserInGroupId(): int
    {
        return $this->user_in_group_id;
    }

    public function setUserInGroupId(int $user_in_group_id): void
    {
        $this->user_in_group_id = $user_in_group_id;
    }
}