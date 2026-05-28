<?php

namespace App\Controllers;

use App\Models\Group;
use App\Models\Zoznam;
use App\Models\ZoznamInGroup;
use App\Models\User;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class ZoznamyController extends BaseController
{

    /**
     * @inheritDoc
     */
    public function index(Request $request): Response
    {
        $groupId = $request->value('groupId');
        $groupName = Group::getOne($groupId)->getName();

        $zoznamy = ZoznamInGroup::getAll("group_id = ?", [$groupId]);
        $allZoznam = Zoznam::getAll();
        $zoznamsInGroup = [];

        foreach ($zoznamy as $zoznamInGroup) {
            foreach ($allZoznam as $zoznam) {
                if ($zoznamInGroup->getZoznamId() == $zoznam->getId()) {
                    $zoznamsInGroup[] = $zoznam;
                }
            }
        }

        $username = $this->app->getAppUser()->getName();
        $userId = User::getAll('`username` = ?', [$username])[0]->getId();

        return $this->html([
            "groupName" => $groupName,
            "zoznamy" => $zoznamsInGroup,
            "loggedUserId" => $userId], "index");
    }
}