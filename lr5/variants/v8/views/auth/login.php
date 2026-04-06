<h2>Вхід</h2>

<form method="post">
    Логін: <input type="text" name="login" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>" required><br>
    Пароль: <input type="password" name="password" required><br>
    <button type="submit">Увійти</button>
</form>