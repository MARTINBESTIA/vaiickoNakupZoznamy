<?php

/** @var array $usersInGroup */
/** @var int $groupId */
/** @var string $groupName */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <h1>Ľudia v skupinke <?= $groupName?></h1>
        </div>
    </div>
    <ul class="list-group">
        <?php foreach ($usersInGroup as $user): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><?= $user->getName() ?></span>
                <form method="post" action="<?= $link->url("Userszoznam.deleteUser")?>">
                    <input type="hidden" id="userId" name="userId" value="<?= $user->getId() ?>">
                    <input type="hidden" id="groupId" name="groupId" value="<?= $groupId ?>">
                    <button class="btn btn-danger" type="submit" name="submit">Remove</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>