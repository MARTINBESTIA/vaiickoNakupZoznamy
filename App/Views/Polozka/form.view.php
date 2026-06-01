<?php
/** @var \App\Models\Polozka $polozka */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <h2>Pridať položku</h2>
            <?php if (!empty($errors ?? [])): ?>
                <?php foreach ($errors as $error): ?>
                    <p class="text-danger"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
            <form method="post" action="<?= $link->url("polozka.save") ?>" enctype="multipart/form-data" onsubmit="validate_polozka(event)">
                <input type="hidden" name="polozkaId" value="<?= htmlspecialchars(@$polozka?->getId() ?? "") ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Názov</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars(@$polozka?->getName() ?? "") ?>" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Množstvo</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="<?= htmlspecialchars(@$polozka?->getAmount() ?? "") ?>" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Cena</label>
                    <input type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars(@$polozka?->getPrice() ?? "") ?>" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="unitType" class="form-label">Jednotka</label>
                    <select name="unitType" id="unitType" class="form-select" required>
                        <option value="ks" <?= @$polozka?->getUnitType() === "ks" ? "selected" : "" ?>>ks</option>
                        <option value="kg" <?= @$polozka?->getUnitType() === "kg" ? "selected" : "" ?>>kg</option>
                        <option value="g" <?= @$polozka?->getUnitType() === "g" ? "selected" : "" ?>>g</option>
                        <option value="l" <?= @$polozka?->getUnitType() === "l" ? "selected" : "" ?>>l</option>
                        <option value="ml" <?= @$polozka?->getUnitType() === "ml" ? "selected" : "" ?>>ml</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Obrázok</label>
                    <input type="file" name="file" id="file">
                </div>

                <button type="submit" class="btn btn-primary">Pridať položku</button>
            </form>
        </div>
    </div>
</div>
