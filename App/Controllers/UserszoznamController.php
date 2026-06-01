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
            'groupId' => $groupId,
            'groupName' => $groupName
        ]);
    }

    public function deleteUser(Request $request): Response
    {
        $userId = $request->value('userId');
        $groupId = $request->value('groupId');

        $userInGroup = UserInGroup::getAll('`user_id` = ? AND `group_id` = ?', [$userId, $groupId])[0] ?? null;
        if ($userInGroup) {
            $userInGroup->delete();
        }
        //todo ajax impl.
        return $this->redirect('?c=userszoznam&groupId=' . $groupId);
    }

    public function addUser(Request $request): Response
    {
        $username = $request->value('username');
        $groupId = $request->value('groupId');

        $users = User::getAll('`username` = ?', [$username]);
        if (empty($users)) {
            return $this->redirect('?c=userszoznam&groupId=' . $groupId);
        }

        $userInGroup = new UserInGroup();
        $userInGroup->setUserId($users[0]->getId());
        $userInGroup->setGroupId($groupId);
        $userInGroup->save();

        return $this->redirect('?c=userszoznam&groupId=' . $groupId);
    }
}