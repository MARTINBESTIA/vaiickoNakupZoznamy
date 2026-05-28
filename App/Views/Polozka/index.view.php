<?php
/** @var array $polozky */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row justify-content-center mt-4">
            <h1>Zoznam všetkých dostupných produktov</h1>
    </div>
    <div class="row justify-content-center mt-4">
        <a href="<?= $link->url("polozkaform.index") ?>" class="btn btn-success">Vytvoriť nový produkt</a>
    </div>
    <ul>
        <?php foreach ($polozky as $polozka): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="card" >
                    <img class="card-img-top" src="<?= $link->asset("../../" . $polozka->getImagePath()) ?>" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"></p>
                    </div>
                </div>
                <li>
                    <span><?= $polozka->getName() ?> </span>
                    <span><?= $polozka->getAmount() ?> <?= $polozka->getUnitType() ?></span>
                <li>
            </li>
        <?php endforeach; ?>
    <ul>
</div>