<?php
session_start();
require_once __DIR__ . '/layout.php';

$data = $_SESSION['user_reg'] ?? null;
$lang = $_COOKIE['lang'] ?? 'uk';

ob_start();
?>
<div class="demo-card">
    <h2>Вітаємо, <?= htmlspecialchars($data['login'] ?? 'Гість') ?>!</h2>
    <p>Мова інтерфейсу (з Cookie): <strong><?= $lang ?></strong></p>

    <?php if ($data): ?>
        <div style="display: flex; gap: 20px; margin-top: 20px;">
            <div style="flex: 1;">
                <?php if ($data['photo']): ?>
                    <img src="<?= $data['photo'] ?>" style="width: 100%; border-radius: 8px; border: 3px solid #eee;">
                <?php else: ?>
                    <div style="width: 150px; height: 150px; background: #eee; display: flex; align-items: center; justify-content: center;">Немає фото</div>
                <?php endif; ?>
            </div>
            <div style="flex: 2;">
                <p><strong>Стать:</strong> <?= $data['gender'] == 'male' ? 'Чоловік' : 'Жінка' ?></p>
                <p><strong>Місто:</strong> <?= htmlspecialchars($data['city']) ?></p>
                <p><strong>Хобі:</strong> <?= !empty($data['hobbies']) ? implode(', ', $data['hobbies']) : 'Не вказано' ?></p>
                <p><strong>Про себе:</strong><br><?= nl2br(htmlspecialchars($data['about'])) ?></p>
            </div>
        </div>
        <a href="task10_form.php" class="btn-submit" style="display: inline-block; margin-top: 20px; text-decoration: none; background: #3498db; color: white; padding: 8px 15px; border-radius: 4px;">Повернутися до редагування</a>
    <?php else: ?>
        <p>Дані відсутні. <a href="task10_form.php">Заповніть форму</a>.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Результат реєстрації');