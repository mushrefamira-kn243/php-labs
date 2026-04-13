<?php
$user = $user ?? [];
$errors = $errors ?? [];
?>

<h1>Редагування профілю</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Виправте помилки:</strong>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=auth/edit" class="form">
    <div class="form__group <?= isset($errors['email']) ? 'form__group--error' : '' ?>">
        <label for="edit_email" class="form__label">E-mail</label>
        <input type="email" id="edit_email" name="email" class="form__input"
               value="<?= htmlspecialchars($user['email'] ?? '') ?>">
        <?php if (isset($errors['email'])): ?>
            <span class="form__error"><?= htmlspecialchars($errors['email']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form__row">
        <div class="form__group <?= isset($errors['first_name']) ? 'form__group--error' : '' ?>">
            <label for="edit_first_name" class="form__label">Ім'я</label>
            <input type="text" id="edit_first_name" name="first_name" class="form__input"
                   value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
            <?php if (isset($errors['first_name'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['first_name']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form__group <?= isset($errors['last_name']) ? 'form__group--error' : '' ?>">
            <label for="edit_last_name" class="form__label">Прізвище</label>
            <input type="text" id="edit_last_name" name="last_name" class="form__input"
                   value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
            <?php if (isset($errors['last_name'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['last_name']) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form__group">
        <label for="edit_phone" class="form__label">Телефон</label>
        <input type="tel" id="edit_phone" name="phone" class="form__input"
               value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
    </div>

    <div class="form__group">
        <label for="edit_city" class="form__label">Місто</label>
        <input type="text" id="edit_city" name="city" class="form__input"
               value="<?= htmlspecialchars($user['city'] ?? '') ?>">
    </div>

    <fieldset class="form__group form__fieldset">
        <legend class="form__label">Стать</legend>
        <div class="form__radio-group">
            <label class="form__radio">
                <input type="radio" name="gender" value="male" <?= ($user['gender'] ?? '') === 'male' ? 'checked' : '' ?>>
                <span>Чоловіча</span>
            </label>
            <label class="form__radio">
                <input type="radio" name="gender" value="female" <?= ($user['gender'] ?? '') === 'female' ? 'checked' : '' ?>>
                <span>Жіноча</span>
            </label>
        </div>
    </fieldset>

    <div class="form__group">
        <label for="edit_about" class="form__label">Про себе</label>
        <textarea id="edit_about" name="about" class="form__textarea"><?= htmlspecialchars($user['about'] ?? '') ?></textarea>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зберегти</button>
        <a href="index.php?route=auth/profile" class="btn btn--secondary">Назад до профілю</a>
    </div>
</form>
