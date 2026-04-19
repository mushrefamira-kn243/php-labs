<?php
$regData = $regData ?? [];
?>

<div class="success-page">
    <div class="alert alert--success">
        <h2>Заявка прийнята!</h2>
        <p>Дякуємо, <strong><?= htmlspecialchars($regData['student_name'] ?? '') ?></strong>.</p>
        <p>Ми отримали ваш запит на пробне заняття з інструментом:
            <strong><?= htmlspecialchars($regData['instrument'] ?? '') ?></strong>.
        </p>
        <p>Контакти для зв’язку: <strong><?= htmlspecialchars($regData['contact_email'] ?? '') ?></strong>,
           <strong><?= htmlspecialchars($regData['phone'] ?? '') ?></strong>.
        </p>
        <p>Обраний рівень: <strong><?= htmlspecialchars($regData['experience'] ?? '') ?></strong>,
           бажана дата: <strong><?= htmlspecialchars($regData['preferred_date'] ?? '') ?></strong>.
        </p>
        <?php if (!empty($regData['notes'])): ?>
            <p>Ваші побажання: <em><?= htmlspecialchars($regData['notes']) ?></em></p>
        <?php endif; ?>
    </div>

    <div class="success-page__actions">
        <a href="index.php" class="btn">На головну</a>
        <a href="index.php?route=regform/form" class="btn btn--secondary">Подати ще одну заявку</a>
    </div>
</div>
