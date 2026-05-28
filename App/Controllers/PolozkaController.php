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


}