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
            "groupId" => $groupId,
            "loggedUserId" => $userId], "index");
    }

    public function delete(Request $request): Response
    {
        $zoznamId = $request->value('zoznamId');
        $groupId = $request->value('groupId');
        $zoznam = Zoznam::getOne($zoznamId);
        $zoznam->delete();

        return $this->redirect($this->url("index", ["groupId" => $groupId]));
    }

    public function showZoznam(Request $request): Response
    {
        $zoznamId = $request->value('zoznamId');
        $groupId = $request->value('groupId');
        $zoznam = Zoznam::getOne($zoznamId);

        return $this->html([
            "zoznam" => $zoznam
        ], "showZoznam");
    }

    public function addZoznam(Request $request): Response
    {
        $groupId = $request->value('groupId');
        $zoznamName = $request->value('zoznamName');

        $zoznam = new Zoznam();
        $zoznam->setName($zoznamName);
        $zoznam->setCreatorId($this->app->getAppUser()->getId());
        $zoznam->setIsBought('N');
        $zoznam->save();

        $zoznamInGroup = new ZoznamInGroup();
        $zoznamInGroup->setGroupId($groupId);
        $zoznamInGroup->setZoznamId($zoznam->getId());
        $zoznamInGroup->save();

        return $this->redirect($this->url("index", ["groupId" => $groupId]));
    }
}