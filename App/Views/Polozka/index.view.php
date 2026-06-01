<?php
/** @var array $polozky */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row justify-content-center mt-4">
            <h1>Zoznam všetkých dostupných produktov</h1>
    </div>
    <div class="row justify-content-center mt-4">
        <a href="<?= $link->url("polozka.add") ?>" class="btn btn-success">Vytvoriť nový produkt</a>
    </div>
    <ul>
        <?php foreach ($polozky as $polozka): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="card" >
                    <img class="card-img-top" style="width: 180px; height: 140px;" src="<?= $link->asset("../../" . $polozka->getImagePath()) ?>" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"></p>
                    </div>
                </div>
                    <span><?= $polozka->getName() ?> </span>
                    <span><?= $polozka->getAmount() ?> <?= $polozka->getUnitType() ?></span>
                    <span><?= $polozka->getPrice() ?> €</span>
                    <a href="<?= $link->url("polozka.edit", ["polozkaId" => $polozka->getId()]) ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= $link->url("polozka.delete", ["polozkaId" => $polozka->getId()]) ?>" class="btn btn-danger">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>