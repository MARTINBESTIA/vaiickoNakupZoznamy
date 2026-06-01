<?php
/** @var string $groupName */
/** @var array $zoznamy */
/** @var int $loggedUserId */
/** @var int $groupId */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <h1>Ľudia v skupinke <?= $groupName?></h1>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Názov zoznamu</th>
                <th scope="col">Stav</th>
                <th scope="col">Akcia</th>
                <th scope="col">Vymazať</th>
            </tr>
            </thead>
            <tbody id="zoznamyTableBody">
            <?php foreach ($zoznamy as $zoznam): ?>
                <tr>
                    <td><?= $zoznam->getName() ?></td>
                    <td>
                        <?php if ($zoznam->getIsBought() == "Y"): ?>
                            Is Bought
                        <?php else: ?>
                            Is not Bought
                        <?php endif; ?>
                    </td>
                    <td><a href="<?= $link->url("zoznamy.showZoznam", ["zoznamId" => $zoznam->getId()]) ?>">Zobraziť zoznam</a></td>
                    <?php if ($zoznam->getCreatorId() == $loggedUserId): ?>
                        <td>
                            <a href="<?= $link->url("zoznamy.editZoznam", ["zoznamId" => $zoznam->getId(), "groupId" => $groupId]) ?>">Upraviť</a>
                            <a href="<?= $link->url("zoznamy.delete", ["zoznamId" => $zoznam->getId(), "groupId" => $groupId]) ?>" class="text-danger">Vymazať zoznam</a>
                        </td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <div class="row justify-content-center mt-4">
        <div class="col-sm-9 col-md-7 col-lg-5 text-center">
            <div class="mt-3">
                <div class="mb-3">
                    <label for="zoznamName" class="form-label">Zadaj meno pre nový zoznam</label>
                    <input type="text" id="zoznamName" class="form-control"
                           placeholder="Názov zoznamu" maxlength="100">
                </div>
                <button onclick="addZoznam(<?= $groupId ?>, <?= $loggedUserId ?>)"
                        class="btn btn-primary">Pridať zoznam</button>
            </div>
        </div>
    </div>
</div>
