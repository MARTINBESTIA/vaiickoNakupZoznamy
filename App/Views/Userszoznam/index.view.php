<?php

/** @var array $usersInGroup */
/** @var int $groupId */
/** @var string $groupName */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row justify-content-center mt-4">
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
    <div class="row justify-content-center mt-4">
        <div class="col-sm-9 col-md-7 col-lg-5 text-center">
            <div id="addUserForm" style="display:block">
                <form method="post" action="<?= $link->url("Userszoznam.addUser") ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Zadaj meno uživateľa pre pridanie do zoznamu</label>
                        <input name="username" type="text" id="username" class="form-control" placeholder="Username"
                               required autofocus>
                        <input type="hidden" id="groupId" name="groupId" value="<?= $groupId ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Pridať uživateľa</button>
                </form>
            </div>
        </div>
    </div>
</div>