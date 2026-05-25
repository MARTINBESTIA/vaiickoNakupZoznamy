<?php

/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <h1>Vitajte v zoznamoch</h1>
            <p><a href="<?= $link->url("zoznamy.create") ?>">Vytvoriť nový zoznam</a></p>
            <p><a href="<?= $link->url("zoznamy.index") ?>">Zobrazit všechny zoznamy</a></p>
        </div>
    </div>
