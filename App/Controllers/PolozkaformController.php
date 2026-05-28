<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

use App\Models\Polozka;

class PolozkaformController extends BaseController
{

    /**
     * @inheritDoc
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }

    public function addPolozka(Request $request): Response
    {
        $name = $request->value('name');
        $amount = $request->value('amount');
        $unitType = $request->value('unitType');
        $file = $request->file('file');

        $polozkaCount = count(Polozka::getAll());

        $imagePath = "uploads/" . $polozkaCount . '_' . time() . '_' . $name . '.jpg';

        $polozka = new Polozka();

        $polozka->setName($name);
        $polozka->setAmount($amount);
        $polozka->setUnitType($unitType);
        $polozka->setImagePath($imagePath);

        $polozka->save();

        $file->store($imagePath);

        return $this->redirect($this->url("polozka.index"));
    }
}