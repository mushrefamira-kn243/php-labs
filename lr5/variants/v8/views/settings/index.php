<?php
$colors = $colors ?? [];
$currentColor = $currentColor ?? '#FFFFF0';
$message = $message ?? '';
$error = $error ?? '';
$currentName = $currentName ?? '';
$currentGender = $currentGender ?? '';
?>

<h1>Налаштування</h1>
<p>Виберіть тему оформлення та налаштуйте персональне привітання для сайту музичної школи.</p>

<?php if ($message !== ''): ?>
    <div class="alert alert--success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($error !== ''): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<section class="info-block">
    <h2>Тема кольорів</h2>
    <p>Оберіть кольорову тему — від світлої класики до насиченого нічного відтінку. Весь сайт адаптується до вибраного фону.</p>

    <form method="POST" action="index.php?route=settings/index" class="form">
        <input type="hidden" name="form_type" value="color">
        <div class="color-picker">
            <?php foreach ($colors as $color => $label): ?>
                <label class="color-swatch<?= $currentColor === $color ? ' color-swatch--active' : '' ?>">
                    <input type="radio" name="bg_color" value="<?= htmlspecialchars($color) ?>" <?= $currentColor === $color ? 'checked' : '' ?>>
                    <span class="color-swatch__preview" style="background: <?= htmlspecialchars($color) ?>"></span>
                    <span class="color-swatch__name"><?= htmlspecialchars($label) ?></span>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form__actions">
            <button type="submit" class="btn">Зберегти тему</button>
        </div>
    </form>
</section>

<section class="info-block">
    <h2>Персональне привітання</h2>
    <p>Створіть дружнє повідомлення для гостей сайту. Це налаштування зберігається у cookie й показується при відвідуванні.</p>

    <form method="POST" action="index.php?route=settings/index" class="form">
        <input type="hidden" name="form_type" value="greeting">

        <div class="form__group">
            <label for="greeting_name" class="form__label">Ваше ім'я</label>
            <input id="greeting_name" name="greeting_name" type="text" class="form__input" value="<?= htmlspecialchars($currentName) ?>" placeholder="Наприклад: Олександр">
        </div>

        <fieldset class="form__group form__fieldset">
            <legend class="form__label">Стать</legend>
            <div class="form__radio-group">
                <label class="form__radio">
                    <input type="radio" name="greeting_gender" value="male" <?= $currentGender === 'male' ? 'checked' : '' ?>>
                    <span>Чоловіча</span>
                </label>
                <label class="form__radio">
                    <input type="radio" name="greeting_gender" value="female" <?= $currentGender === 'female' ? 'checked' : '' ?>>
                    <span>Жіноча</span>
                </label>
            </div>
        </fieldset>

        <div class="form__actions">
            <button type="submit" class="btn">Зберегти привітання</button>
        </div>
    </form>
</section>

<section class="info-block">
    <h2>Попередній перегляд</h2>
    <p>Поточна тема: <strong><?= htmlspecialchars($colors[$currentColor] ?? 'Власний колір') ?></strong>.</p>
    <p>Поточне привітання: <strong><?= $currentName !== '' ? htmlspecialchars($currentName) : 'Не задано' ?></strong></p>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorSwatches = document.querySelectorAll('.color-swatch');
    colorSwatches.forEach(swatch => {
        swatch.addEventListener('click', function() {
            colorSwatches.forEach(s => s.classList.remove('color-swatch--active'));
            this.classList.add('color-swatch--active');
        });
    });
});
</script>
