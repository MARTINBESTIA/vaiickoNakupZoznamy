<?php

/** @var array $usersInGroup */
/** @var string $groupName */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <h1>=Ľudia v skupinke <?= $groupName?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <ul>
                <?php foreach ($usersInGroup as $user): ?>
                    <li><?= $user->getName() ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>