<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

use App\Models\Zoznam;
use App\Models\Polozka;
use App\Models\PolozkasInZoznam;

class ZoznampolozkyController extends BaseController
{

    /**
     * @inheritDoc
     */
    public function index(Request $request): Response
    {
        $zoznamId = $request->value('zoznamId');
        $search = $request->value('search');
        $zoznam = Zoznam::getOne($zoznamId);

        $polozkyInZoznamRaw = PolozkasInZoznam::getAll('`zoznam_id` = ?', [$zoznamId]);
        $allPolozky = Polozka::getAll();
        $polozkyInZoznam = [];

        foreach ($polozkyInZoznamRaw as $polozkaInZoznam) {
            foreach ($allPolozky as $polozka) {
                if ($polozkaInZoznam->getPolozkaId() == $polozka->getId()) {
                    $polozkyInZoznam[] = [
                        'polozka' => $polozka,
                        'polozkaInZoznam' => $polozkaInZoznam
                    ];
                }
            }
        }

        $searchResults = null;
        if ($search !== null && $search !== '') {
            $searchResults = array_values(array_filter($allPolozky, function ($p) use ($search) {
                return stripos($p->getName(), $search) !== false;
            }));
        }

        return $this->html([
            'zoznamId'      => $zoznamId,
            'zoznamName'    => $zoznam->getName(),
            'zoznamIsBought'=> $zoznam->getIsBought(),
            'polozky'       => $polozkyInZoznam,
            'searchResults' => $searchResults,
            'search'        => $search ?? ''
        ]);
    }

    public function addPolozka(Request $request): Response
    {
        $polozkaId = $request->value('polozkaId');
        $zoznamId  = $request->value('zoznamId');
        $search    = $request->value('search');

        if ($polozkaId <= 0 || $zoznamId <= 0) {
            return $this->redirect($this->url('index', ['zoznamId' => $zoznamId, 'search' => $search]));
        }
        /*
        $existing = PolozkasInZoznam::getAll('`polozka_id` = ? AND `zoznam_id` = ?', [$polozkaId, $zoznamId]);
        if (empty($existing)) {
            return $this->redirect($this->url('index', [
                'zoznamId' => $zoznamId,
                'search' => $search]));
        } */

        $entry = new PolozkasInZoznam();
        $entry->setPolozkaId($polozkaId);
        $entry->setZoznamId($zoznamId);
        $entry->setQuantity(1);
        $entry->setIsChecked('N');
        $entry->save();

        return $this->redirect($this->url('index', [
            'zoznamId' => $zoznamId,
            'search'   => $search
        ]));
    }

    public function toggleChecked(Request $request): Response
    {
        $polozkaInZoznamId = $request->value('polozkaInZoznamId');
        $zoznamId          = $request->value('zoznamId');

        if ($polozkaInZoznamId <= 0 || $zoznamId <= 0) {
            return $this->redirect($this->url('index', ['zoznamId' => $zoznamId]));
        }

        $entry = PolozkasInZoznam::getOne($polozkaInZoznamId);
        if ($entry === null) {
            return $this->redirect($this->url('index', ['zoznamId' => $zoznamId]));
        }

        $newChecked = $entry->getIsChecked() === 'Y' ? 'N' : 'Y';
        $entry->setIsChecked($newChecked);
        $entry->save();

        if ($newChecked === 'Y') {
            $zoznam = Zoznam::getOne($zoznamId);
            if ($zoznam->getIsBought() !== 'Y') {
                $zoznam->setIsBought('Y');
                $zoznam->save();
            }
        }

        return $this->redirect($this->url('index', ['zoznamId' => $zoznamId]));
    }

    public function toggleZoznamBought(Request $request): Response
    {
        $zoznamId = (int) $request->value('zoznamId');
        if ($zoznamId <= 0) {
            return $this->redirect($this->url('index', ['zoznamId' => $zoznamId]));
        }

        $zoznam = Zoznam::getOne($zoznamId);
        $zoznam->setIsBought($zoznam->getIsBought() === 'Y' ? 'N' : 'Y');
        $zoznam->save();

        return $this->redirect($this->url('index', ['zoznamId' => $zoznamId]));
    }

    public function getItems(Request $request): Response
    {
        $zoznamId = (int) $request->value('zoznamId');
        if ($zoznamId <= 0) {
            return $this->json(['error' => 'Neplatné ID zoznamu']);
        }

        $zoznam = Zoznam::getOne($zoznamId);
        $polozkyInZoznamRaw = PolozkasInZoznam::getAll('`zoznam_id` = ?', [$zoznamId]);

        $items = [];
        foreach ($polozkyInZoznamRaw as $entry) {
            $items[] = [
                'id'         => $entry->getPolozkaInZoznamId(),
                'is_checked' => $entry->getIsChecked()
            ];
        }

        return $this->json([
            'items'            => $items,
            'zoznam_is_bought' => $zoznam->getIsBought()
        ]);
    }
}
