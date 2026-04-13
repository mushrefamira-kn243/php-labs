<?php
$instrument = $instrument ?? [];
$errors = $errors ?? [];
?>

<h1>Редагувати інструмент #<?= (int)($instrument['id'] ?? 0) ?></h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Помилки:</strong>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=recipe/edit&id=<?= (int)($instrument['id'] ?? 0) ?>" class="form">
    <div class="form__group <?= isset($errors['name']) ? 'form__group--error' : '' ?>">
        <label for="i_name" class="form__label">Назва інструменту <span class="required">*</span></label>
        <input type="text" id="i_name" name="name" class="form__input"
               value="<?= htmlspecialchars($instrument['name'] ?? '') ?>">
        <?php if (isset($errors['name'])): ?>
            <span class="form__error"><?= htmlspecialchars($errors['name']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form__row">
        <div class="form__group <?= isset($errors['type']) ? 'form__group--error' : '' ?>">
            <label for="i_type" class="form__label">Тип <span class="required">*</span></label>
            <select id="i_type" name="type" class="form__input">
                <option value="">Оберіть тип</option>
                <option value="струнний" <?= ($instrument['type'] ?? '') === 'струнний' ? 'selected' : '' ?>>Струнний</option>
                <option value="духовий" <?= ($instrument['type'] ?? '') === 'духовий' ? 'selected' : '' ?>>Духовий</option>
                <option value="ударний" <?= ($instrument['type'] ?? '') === 'ударний' ? 'selected' : '' ?>>Ударний</option>
            </select>
            <?php if (isset($errors['type'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['type']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form__group">
            <label for="i_brand" class="form__label">Виробник</label>
            <input type="text" id="i_brand" name="brand" class="form__input"
                   value="<?= htmlspecialchars($instrument['brand'] ?? '') ?>">
        </div>
    </div>

    <div class="form__row">
        <div class="form__group <?= isset($errors['price']) ? 'form__group--error' : '' ?>">
            <label for="i_price" class="form__label">Ціна (грн)</label>
            <input type="number" id="i_price" name="price" class="form__input" min="0" step="0.01"
                   value="<?= htmlspecialchars($instrument['price'] ?? '') ?>">
            <?php if (isset($errors['price'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['price']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form__group">
            <label for="i_condition" class="form__label">Стан</label>
            <select id="i_condition" name="condition" class="form__input">
                <option value="">Оберіть стан</option>
                <option value="новий" <?= ($instrument['condition'] ?? '') === 'новий' ? 'selected' : '' ?>>Новий</option>
                <option value="б/в" <?= ($instrument['condition'] ?? '') === 'б/в' ? 'selected' : '' ?>>Б/в</option>
                <option value="відмінний" <?= ($instrument['condition'] ?? '') === 'відмінний' ? 'selected' : '' ?>>Відмінний</option>
            </select>
        </div>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зберегти</button>
        <a href="index.php?route=recipe/list" class="btn btn--secondary">Скасувати</a>
    </div>
</form>
