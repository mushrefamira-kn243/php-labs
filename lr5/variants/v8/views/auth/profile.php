<?php
$user = $user ?? [];
?>

<h1>Профіль користувача</h1>

<div class="card">
    <h2 class="card__title"><?= htmlspecialchars($user['login'] ?? '') ?></h2>
    <p><strong>E-mail:</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>
    <p><strong>Ім'я:</strong> <?= htmlspecialchars($user['first_name'] ?? '') ?></p>
    <p><strong>Прізвище:</strong> <?= htmlspecialchars($user['last_name'] ?? '') ?></p>
    <p><strong>Телефон:</strong> <?= htmlspecialchars($user['phone'] ?? '') ?></p>
    <p><strong>Місто:</strong> <?= htmlspecialchars($user['city'] ?? '') ?></p>
    <p><strong>Стать:</strong> <?= htmlspecialchars($user['gender'] === 'female' ? 'Жіноча' : 'Чоловіча') ?></p>
    <p><strong>Про себе:</strong> <?= nl2br(htmlspecialchars($user['about'] ?? '')) ?></p>
    <div class="form__actions">
        <a href="index.php?route=auth/edit" class="btn">Редагувати профіль</a>
        <a href="index.php?route=auth/delete" class="btn btn--secondary">Видалити акаунт</a>
    </div>
</div>
