<?php
/** @var array $groups */
/** @var int $currentUserId */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="py-3">
            <form method="post" action="<?= $link->url('groups.addGroup') ?>">
                <div class="mb-3">
                    <label for="groupName" class="form-label">Zadaj meno pre novú skupinu</label>
                    <input type="text" name="groupName" id="groupName" class="form-control"
                           placeholder="Názov skupiny" required minlength="2" maxlength="100">
                </div>
                <button type="submit" class="btn btn-primary">Vytvoriť skupinu</button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Názov skupiny</th>
                <th scope="col">Počet ľudí</th>
                <th >
            </tr>
            </thead>
            <tbody>
            <?php foreach ($groups as $group): ?>
                <tr>
                    <td><?= $group->getName() ?></td>
                    <td><a href="<?= $link->url("zoznamy.index", ["groupId" => $group->getId()]) ?>">Zobraziť zoznamy</a></td>
                    <?php if ($group->getCreatorId() === $currentUserId): ?>
                        <td><a href="<?= $link->url("userszoznam.index", ["groupId" => $group->getId()]) ?>">Spravovať ľudí</a></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



