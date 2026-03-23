<?php
$regData = $regData ?? [];
?>

<div class="success-page">

    <div class="alert alert--success">

        <h2>Реєстрація успішна!</h2>

        <p>
            Вітаємо у музичній школі,
            <strong><?= htmlspecialchars($regData['login'] ?? '') ?></strong>!
        </p>

        <p>
            Тепер ви будете отримувати розклад занять
            та навчальні матеріали на вашу електронну пошту:
            <strong><?= htmlspecialchars($regData['email'] ?? '') ?></strong>
        </p>

    </div>

    <div class="success-page__actions">

        <a href="index.php" class="btn">
            На головну
        </a>

        <a href="index.php?route=regform/form" class="btn btn--secondary">
            Нова реєстрація
        </a>

    </div>

</div>