<?php

namespace App\Controllers;

use App\Models\User;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use App\Models\Group;
use App\Models\UserInGroup;

class GroupsController extends BaseController
{

    function addUser(Request $request): Response
    {
        $username = $request->value('username');
        $groupId = $request->value('groupId');

        $users = User::getAll('`username` = ?', [$username]);

        if (empty($users)) {
            return $this->json(['success' => false, 'message' => 'Používateľ neexistuje, skús to znova.']);
        }

        $user = $users[0];
        $userInThisGroup = UserInGroup::getAll('`group_id` = ? and user_id = ?', [$groupId, $user->getId()]);

        if (!empty($userInThisGroup)) {
            return $this->json(['success' => false, 'message' => 'Používateľ už je v tejto skupine.']);
        }

        $userInGroup = new UserInGroup();
        $userInGroup->setGroupId($groupId);
        $userInGroup->setUserId($user->getId());
        $userInGroup->save();

        return $this->json(['success' => true, 'message' => 'Používateľ bol úspešne pridaný do skupiny.']);
    }


    function index(Request $request): Response
    {
        $username = $this->app->getAppUser()->getName();
        $userId = User::getAll('`username` = ?', [$username])[0]->getId();
        $userInGroups = UserInGroup::getAll('`user_id` = ?', [$userId]);
        $groups = Group::getAll();
        $finalGroups = [];

        foreach ($groups as $group) {
            foreach ($userInGroups as $userInGroup) {
                if ($userInGroup->getGroupId() == $group->getId()) {
                    $finalGroups[] = $group;
                }
            }
        }

        return $this->html(['groups' => $finalGroups, 'currentUserId' => $userId], 'index');
    }
}