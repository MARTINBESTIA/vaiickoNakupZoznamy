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

        return $this->html(['groups' => $finalGroups], 'index');
    }
}