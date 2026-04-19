<?php
$errors = $errors ?? [];
$old = $old ?? [];
?>

<h1>Запис на пробне заняття</h1>
<p>Заповніть форму для бронювання пробного уроку або прослуховування у музичній школі.</p>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Виправте помилки:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=regform/form" class="form">
    <div class="form__group<?= isset($errors['student_name']) ? ' form__group--error' : '' ?>">
        <label for="student_name" class="form__label">Ім'я учня</label>
        <input type="text" id="student_name" name="student_name" class="form__input"
               value="<?= htmlspecialchars($old['student_name'] ?? '') ?>"
               placeholder="Ім'я або прізвище">
    </div>

    <div class="form__row">
        <div class="form__group<?= isset($errors['contact_email']) ? ' form__group--error' : '' ?>">
            <label for="contact_email" class="form__label">E-mail</label>
            <input type="email" id="contact_email" name="contact_email" class="form__input"
                   value="<?= htmlspecialchars($old['contact_email'] ?? '') ?>"
                   placeholder="student@example.com">
        </div>

        <div class="form__group<?= isset($errors['phone']) ? ' form__group--error' : '' ?>">
            <label for="phone" class="form__label">Телефон</label>
            <input type="tel" id="phone" name="phone" class="form__input"
                   value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
                   placeholder="+380...">
        </div>
    </div>

    <div class="form__row">
        <div class="form__group<?= isset($errors['preferred_instrument']) ? ' form__group--error' : '' ?>">
            <label for="preferred_instrument" class="form__label">Інструмент / напрямок</label>
            <select id="preferred_instrument" name="preferred_instrument" class="form__select">
                <option value="">Виберіть...</option>
                <option value="Піаніно"<?= ($old['preferred_instrument'] ?? '') === 'Піаніно' ? ' selected' : '' ?>>Піаніно</option>
                <option value="Гітара"<?= ($old['preferred_instrument'] ?? '') === 'Гітара' ? ' selected' : '' ?>>Гітара</option>
                <option value="Скрипка"<?= ($old['preferred_instrument'] ?? '') === 'Скрипка' ? ' selected' : '' ?>>Скрипка</option>
                <option value="Барабани"<?= ($old['preferred_instrument'] ?? '') === 'Барабани' ? ' selected' : '' ?>>Барабани</option>
                <option value="Саксофон"<?= ($old['preferred_instrument'] ?? '') === 'Саксофон' ? ' selected' : '' ?>>Саксофон</option>
                <option value="Вокал"<?= ($old['preferred_instrument'] ?? '') === 'Вокал' ? ' selected' : '' ?>>Вокал</option>
            </select>
        </div>

        <div class="form__group<?= isset($errors['experience_level']) ? ' form__group--error' : '' ?>">
            <label for="experience_level" class="form__label">Рівень</label>
            <select id="experience_level" name="experience_level" class="form__select">
                <option value="">Виберіть...</option>
                <option value="beginner"<?= ($old['experience_level'] ?? '') === 'beginner' ? ' selected' : '' ?>>Початковий</option>
                <option value="intermediate"<?= ($old['experience_level'] ?? '') === 'intermediate' ? ' selected' : '' ?>>Середній</option>
                <option value="advanced"<?= ($old['experience_level'] ?? '') === 'advanced' ? ' selected' : '' ?>>Досвідчений</option>
            </select>
        </div>
    </div>

    <div class="form__group<?= isset($errors['preferred_date']) ? ' form__group--error' : '' ?>">
        <label for="preferred_date" class="form__label">Бажана дата заняття</label>
        <input type="date" id="preferred_date" name="preferred_date" class="form__input"
               value="<?= htmlspecialchars($old['preferred_date'] ?? '') ?>">
    </div>

    <div class="form__group">
        <label for="notes" class="form__label">Додаткова інформація</label>
        <textarea id="notes" name="notes" class="form__textarea" placeholder="Розкажіть про ваші бажання чи попередній досвід..."><?= htmlspecialchars($old['notes'] ?? '') ?></textarea>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Відправити заявку</button>
        <button type="reset" class="btn btn--secondary">Очистити</button>
    </div>
</form>
