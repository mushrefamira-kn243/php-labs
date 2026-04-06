<h2>Редагувати профіль</h2>

<form method="post">
    Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required><br>
    Ім'я: <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required><br>
    Прізвище: <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" required><br>
    Телефон: <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>"><br>
    Місто: <input type="text" name="city" value="<?= htmlspecialchars($user['city'] ?? '') ?>"><br>
    Стать: 
    <select name="gender">
        <option value="male" <?= ( ($user['gender'] ?? '') === 'male' ) ? 'selected' : '' ?>>Чоловік</option>
        <option value="female" <?= ( ($user['gender'] ?? '') === 'female' ) ? 'selected' : '' ?>>Жінка</option>
    </select><br>
    Про себе: <textarea name="about"><?= htmlspecialchars($user['about'] ?? '') ?></textarea><br>
    <button type="submit">Зберегти</button>
</form>