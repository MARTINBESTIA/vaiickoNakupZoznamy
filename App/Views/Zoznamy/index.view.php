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
            <tbody>
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
                        <td><a href="<?= $link->url("zoznamy.delete", ["zoznamId" => $zoznam->getId(), "groupId" => $groupId]) ?>" class="text-danger">Vymazať zoznam</a></td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <div class="row justify-content-center mt-4">
        <div class="col-sm-9 col-md-7 col-lg-5 text-center">
            <div id="addUserForm" style="display:block">
                <form method="post" action="<?= $link->url("zoznamy.addZoznam") ?>">
                    <div class="mb-3">
                        <label for="zoznamName" class="form-label">Zadaj meno pre nový zoznam</label>
                        <input name="zoznamName" type="text" id="zoznamName" class="form-control" placeholder="zoznamName"
                               required autofocus>
                        <input type="hidden" id="groupId" name="groupId" value="<?= $groupId ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Pridať zoznam</button>
                </form>
            </div>
        </div>
    </div>
</div>
