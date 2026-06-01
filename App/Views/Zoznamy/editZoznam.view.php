<?php
/** @var \App\Models\Zoznam $zoznam */
/** @var int $groupId */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container mt-4">
    <h2>Upraviť zoznam</h2>
    <?php foreach ($errors as $error): ?>
        <p class="text-danger"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
    <form method="post" action="<?= $link->url('zoznamy.updateZoznam') ?>" onsubmit="validate_editZoznam(event)">
        <input type="hidden" name="zoznamId" value="<?= $zoznam->getId() ?>">
        <input type="hidden" name="groupId" value="<?= $groupId ?>">
        <div class="mb-3">
            <label for="zoznamName" class="form-label">Názov zoznamu</label>
            <input type="text" name="zoznamName" id="zoznamName" class="form-control"
                   value="<?= htmlspecialchars($zoznam->getName()) ?>" required minlength="2" maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Uložiť</button>
        <a href="<?= $link->url('zoznamy.index', ['groupId' => $groupId]) ?>" class="btn btn-secondary">Zrušiť</a>
    </form>
</div>
