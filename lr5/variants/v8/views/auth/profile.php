<h2>Профіль</h2>

<p>Логін: <?= htmlspecialchars($user['login'] ?? '') ?></p>
<p>Email: <?= htmlspecialchars($user['email'] ?? '') ?></p>
<p>Ім'я: <?= htmlspecialchars($user['first_name'] ?? '') ?> <?= htmlspecialchars($user['last_name'] ?? '') ?></p>

<a href="/auth/edit">Редагувати</a> | 
<a href="/auth/delete" onclick="return confirm('Ви впевнені, що хочете видалити акаунт?')">Видалити</a> | 
<a href="/auth/logout">Вийти</a>