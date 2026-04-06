<?php
$colors = $colors ?? [];
$currentColor = $currentColor ?? '#FFFAF0';
$message = $message ?? '';
$messageType = $messageType ?? 'success';
?>

<h1>Колір фону</h1>
<p>Оберіть колір фону для музичної школи. Зміна зберігається в сесії.</p>

<?php if ($message !== ''): ?>
    <div class="alert alert--<?= $messageType === 'error' ? 'error' : 'success' ?>"><?= htmlspecialchars($message) ?></div>
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

<h2>Вибір кольору фону</h2>
<form method="post">
    <select name="color">
        <option value="nocturne_blue">Ноктюрн синій</option>
        <option value="classic_ivory">Класична слонова кістка</option>
        <option value="royal_black">Рояльний чорний</option>
        <option value="gold_notes">Золото нот</option>
        <option value="chord_lavender">Акордова бузкова</option>
    </select>
    <button type="submit">Зберегти</button>
</form>

<?php
if (isset($_SESSION['bg_color'])) {
    echo '<style>body { background-color: ' . $_SESSION['bg_color'] . '; }</style>';
}
if (!isset($_COOKIE['greeting'])) {
    setcookie('greeting', 'Привіт, музиканте!', time() + 30 * 24 * 3600);
}
echo $_COOKIE['greeting'] ?? 'Привіт!';
?>
