<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

use App\Models\Polozka;

class PolozkaController extends BaseController
{

    /**
     * @inheritDoc
     */
    public function index(Request $request): Response
    {
        $polozky = Polozka::getAll();

        return $this->html(["polozky" => $polozky], "index");
    }

    public function add(Request $request): Response
    {
        return $this->html();
    }

    public function edit(Request $request): Response
    {
        $polozkaId = $request->value('polozkaId');
        $polozka = Polozka::getOne($polozkaId);

        return $this->html(["polozka" => $polozka]);
    }

    public function save(Request $request): Response
    {
        $name = $request->value('name');
        $amount = $request->value('amount');
        $unitType = $request->value('unitType');
        $price = $request->value('price');
        $file = $request->file('file');

        $polozkaId = $request->value('polozkaId');
        $polozka = Polozka::getOne($polozkaId);

        $polozkaCount = count(Polozka::getAll());

        $imagePath = "uploads/" . $polozkaCount . '_' . time() . '_' . $name . '.jpg';

        if ($polozka) {
            $polozka->setName($name);
            $polozka->setAmount($amount);
            $polozka->setPrice($price);
            $polozka->setUnitType($unitType);

            if ($file) {
                $polozka->setImagePath($imagePath);
                $file->store($imagePath);
            }

            $polozka->save();

            return $this->redirect($this->url("polozka.index"));
        }

        $polozka = new Polozka();

        $polozka->setName($name);
        $polozka->setAmount($amount);
        $polozka->setPrice($price);
        $polozka->setUnitType($unitType);
        $polozka->setImagePath($imagePath);

        $polozka->save();

        $file->store($imagePath);

        return $this->redirect($this->url("polozka.index"));
    }


}