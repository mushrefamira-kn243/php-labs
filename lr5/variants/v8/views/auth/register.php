<h2>Реєстрація</h2>

<form method="post">
    Логін: <input type="text" name="login" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>" required><br>
    Пароль: <input type="password" name="password" required><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required><br>
    Ім'я: <input type="text" name="first_name" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required><br>
    Прізвище: <input type="text" name="last_name" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required><br>
    Телефон: <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"><br>
    Місто: <input type="text" name="city" value="<?= htmlspecialchars($_POST['city'] ?? '') ?>"><br>
    Стать: 
    <select name="gender">
        <option value="male" <?= (($_POST['gender'] ?? '') === 'male') ? 'selected' : '' ?>>Чоловік</option>
        <option value="female" <?= (($_POST['gender'] ?? '') === 'female') ? 'selected' : '' ?>>Жінка</option>
    </select><br>
    Про себе: <textarea name="about"><?= htmlspecialchars($_POST['about'] ?? '') ?></textarea><br>
    <button type="submit">Зареєструватися</button>
</form>