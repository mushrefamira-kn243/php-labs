<?php
$colors = $colors ?? [];
$currentColor = $currentColor ?? '#FFFFF0';
$message = $message ?? '';
$error = $error ?? '';
?>

<h1>Колір фону</h1>
<p>Оберіть колір фону для музичної школи. Зміна зберігається в сесії.</p>

<?php if ($error !== ''): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if ($message !== ''): ?>
    <div class="alert alert--success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="POST" action="index.php?route=settings/color" class="form">
    <div class="color-picker">
        <?php foreach ($colors as $hex => $name): ?>
            <label class="color-swatch<?= $hex === $currentColor ? ' color-swatch--active' : '' ?>">
                <input type="radio" name="bg_color" value="<?= htmlspecialchars($hex) ?>"
                       <?= $hex === $currentColor ? 'checked' : '' ?>>
                <span class="color-swatch__preview" style="background-color: <?= htmlspecialchars($hex) ?>"></span>
                <span class="color-swatch__name"><?= htmlspecialchars($name) ?></span>
            </label>
        <?php endforeach; ?>
    </div>

    <button type="submit" class="btn">Зберегти</button>
</form>

<p class="text-muted text-muted--mt">Також доступне <a href="index.php?route=settings/greeting">налаштування привітання</a>.</p>
