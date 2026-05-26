<?php
/** @var array $groups */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <h1>Zoznam skupiniek</h1>
            <p><a href="<?= $link->url("groups.create") ?>">Vytvoriť novú skupinu</a></p>

        </div>
        <div class="py-3">
            <button type="button"
                    onclick="window.location.href='<?= $link->url("home.index") ?>'"
                    class="btn btn-primary tlacidlo-prekliknutie p-3">Vytvor novú skupinu
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Názov skupiny</th>
                <th scope="col">Počet ľudí</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($groups as $group): ?>
                <tr>
                    <td><?= $group->getName() ?></td>
                    <td><a href="<?= $link->url("groups.show", ["id" => $group->getId()]) ?>">Zobraziť zoznam</a></td>
                    <td><a href="<?= $link->url("groups.show", ["id" => $group->getId()]) ?>">Pridať ľudí</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>