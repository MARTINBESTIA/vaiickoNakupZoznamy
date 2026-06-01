<?php
/** @var int $zoznamId */
/** @var string $zoznamName */
/** @var string $zoznamIsBought */
/** @var array $polozky */
/** @var array|null $searchResults */
/** @var string $search */
/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="container mt-4">
    <h2><?= htmlspecialchars($zoznamName) ?></h2>

    <div class="form-check mt-2 mb-3">
        <form method="post" action="<?= $link->url('zoznampolozky.toggleZoznamBought') ?>">
            <input type="hidden" name="zoznamId" value="<?= $zoznamId ?>">
            <input type="checkbox" class="form-check-input" id="zoznamBought"
                   onchange="this.form.submit()"
                    <?= $zoznamIsBought === 'Y' ? 'checked' : '' ?>>
            <label class="form-check-label" for="zoznamBought">Zoznam kúpený</label>
        </form>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-sm mt-3">
        <thead>
        <tr>
            <th>Názov</th>
            <th>Množstvo</th>
            <th>Jednotka</th>
            <th>Cena</th>
            <th>Kúpené</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($polozky as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['polozka']->getName()) ?></td>
                <td><?= $item['polozkaInZoznam']->getQuantity() ?></td>
                <td><?= htmlspecialchars($item['polozka']->getUnitType()) ?></td>
                <td><?= $item['polozka']->getPrice() ?> €</td>
                <td>
                    <form method="post" action="<?= $link->url('zoznampolozky.toggleChecked') ?>">
                        <input type="hidden" name="polozkaInZoznamId" value="<?= $item['polozkaInZoznam']->getPolozkaInZoznamId() ?>">
                        <input type="hidden" name="zoznamId" value="<?= $zoznamId ?>">
                        <input type="checkbox"
                               id="item-check-<?= $item['polozkaInZoznam']->getPolozkaInZoznamId() ?>"
                               onchange="this.form.submit()"
                                <?= $item['polozkaInZoznam']->getIsChecked() === 'Y' ? 'checked' : '' ?>>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <h2 class="mt-5">Pridať položku do zoznamu</h2>

    <form method="get" action="" class="d-flex gap-2 mt-3">
        <input type="hidden" name="c" value="zoznampolozky">
        <input type="hidden" name="zoznamId" value="<?= $zoznamId ?>">
        <input type="text" name="search" class="form-control" placeholder="Hľadať produkt..." value="<?=
        htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-primary">Hľadať</button>
    </form>

    <script>itemRefresh(<?= $zoznamId ?>);</script>

    <?php if ($searchResults !== null): ?>
        <div class="table-responsive">
        <table class="table table-striped table-sm mt-3">
            <thead>
            <tr>
                <th>Názov</th>
                <th>Množstvo</th>
                <th>Jednotka</th>
                <th>Cena</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($searchResults)): ?>
                <tr><td colspan="5" class="text-center">Žiadne výsledky</td></tr>
            <?php else: ?>
                <?php foreach ($searchResults as $polozka): ?>
                    <tr>
                        <td><?= htmlspecialchars($polozka->getName()) ?></td>
                        <td><?= $polozka->getAmount() ?></td>
                        <td><?= htmlspecialchars($polozka->getUnitType()) ?></td>
                        <td><?= $polozka->getPrice() ?> €</td>
                        <td>
                            <form method="post" action="<?= $link->url('zoznampolozky.addPolozka') ?>">
                                <input type="hidden" name="polozkaId" value="<?= $polozka->getId() ?>">
                                <input type="hidden" name="zoznamId" value="<?= $zoznamId ?>">
                                <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
                                <button type="submit" class="btn btn-success btn-sm">Pridať</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>
</div>