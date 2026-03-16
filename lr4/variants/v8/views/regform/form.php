<?php
$errors = $errors ?? [];
$old = $old ?? [];
?>

<h1>Реєстрація учня музичної школи</h1>
<p>Заповніть форму, щоб зареєструватися в системі музичної школи.</p>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Помилки при заповненні форми:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=regform/save" class="form">

    <div class="form__group">
        <label for="login" class="form__label">Логін</label>
        <input type="text"
               id="login"
               name="login"
               class="form__input<?= isset($errors['login']) ? ' form__input--error' : '' ?>"
               value="<?= htmlspecialchars($old['login'] ?? '') ?>"
               placeholder="Нікнейм учня">
    </div>

    <div class="form__group">
        <label for="password1" class="form__label">Пароль</label>
        <input type="password"
               id="password1"
               name="password1"
               class="form__input<?= isset($errors['password1']) ? ' form__input--error' : '' ?>"
               placeholder="Мінімум 5 символів і хоча б одна цифра">
    </div>

    <div class="form__group">
        <label for="password2" class="form__label">Підтвердження пароля</label>
        <input type="password"
               id="password2"
               name="password2"
               class="form__input<?= isset($errors['password2']) ? ' form__input--error' : '' ?>"
               placeholder="Повторіть пароль">
    </div>

    <div class="form__group">
        <label for="email" class="form__label">E-mail</label>
        <input type="email"
               id="email"
               name="email"
               class="form__input<?= isset($errors['email']) ? ' form__input--error' : '' ?>"
               value="<?= htmlspecialchars($old['email'] ?? '') ?>"
               placeholder="student@music.ua">
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зареєструватися</button>
        <button type="reset" class="btn btn--secondary">Очистити</button>
    </div>

</form>