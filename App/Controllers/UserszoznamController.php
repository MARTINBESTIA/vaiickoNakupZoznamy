<?php

namespace App\Controllers;

use App\Models\Group;
use App\Models\User;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use App\Models\UserInGroup;

class UserszoznamController extends BaseController
{

    /**
     * Táto class predstavuje zoznam ľudí ktorý sa nachádzajú v skupine. Nie ktorý ľudia sú pri zozname to je samozrejme nemožné pri danom db návrhu.
     */
    public function index(Request $request): Response
    {
        $groupId = $request->value('groupId');
        $groupName = Group::getOne($groupId)->getName();
        $usersInGroup = UserInGroup::getAll('`group_id` = ?', [$groupId]);
        $allUsers = User::getAll();
        $userEntitiesInGroup = [];

        foreach ($usersInGroup as $userInGroup) {
            foreach ($allUsers as $user) {
                if ($userInGroup->getUserId() === $user->getId()) {
                    $userEntitiesInGroup[] = $user;
                }
            }
        }

        return $this->html([
            'usersInGroup' => $userEntitiesInGroup,
            'groupName' => $groupName
        ]);

    }
}