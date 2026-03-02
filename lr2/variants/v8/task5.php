<?php
/**
 * Завдання 5: Генератор паролів
 * Варіант 8: Довжина 15, без підрядка логіну
 */
require_once __DIR__ . '/layout.php';

/**
 * Базовий генератор пароля за вимогами
 */
function generatePassword(int $length = 15): string
{
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $digits = '0123456789';
    $special = '!@#$%^&*()-_=+';
    $all = $upper . $lower . $digits . $special;

    $password = '';
    // Гарантуємо мінімум по одному символу кожного типу
    $password .= $upper[random_int(0, strlen($upper) - 1)];
    $password .= $lower[random_int(0, strlen($lower) - 1)];
    $password .= $digits[random_int(0, strlen($digits) - 1)];
    $password .= $special[random_int(0, strlen($special) - 1)];

    // Добираємо решту до потрібної довжини
    for ($i = 4; $i < $length; $i++) {
        $password .= $all[random_int(0, strlen($all) - 1)];
    }

    return str_shuffle($password);
}

/**
 * Перевірка на наявність підрядка логіну (>= 3 символи)
 */
function containsLoginSubstring(string $password, string $login, int $minLength = 3): bool
{
    $login = mb_strtolower($login);
    $password = mb_strtolower($password);
    $loginLen = mb_strlen($login);

    for ($len = $minLength; $len <= $loginLen; $len++) {
        for ($start = 0; $start <= $loginLen - $len; $start++) {
            $sub = mb_substr($login, $start, $len);
            if (strpos($password, $sub) !== false) {
                return true;
            }
        }
    }
    return false;
}

/**
 * Генератор з перевіркою логіну
 */
function generateSecurePassword(int $length, string $login): string
{
    do {
        $password = generatePassword($length);
    } while (containsLoginSubstring($password, $login));
    
    return $password;
}

/**
 * Розрахунок складності (0-5 балів)
 */
function checkStrength(string $password): array
{
    $checks = [
        'length'  => ['label' => 'Довжина ≥ 8', 'passed' => strlen($password) >= 8],
        'upper'   => ['label' => 'Велика літера', 'passed' => (bool)preg_match('/[A-Z]/', $password)],
        'lower'   => ['label' => 'Мала літера', 'passed' => (bool)preg_match('/[a-z]/', $password)],
        'digit'   => ['label' => 'Цифра', 'passed' => (bool)preg_match('/[0-9]/', $password)],
        'special' => ['label' => 'Спецсимвол', 'passed' => (bool)preg_match('/[!@#$%^&*()\-_=+]/', $password)],
    ];

    $score = 0;
    foreach ($checks as $c) if ($c['passed']) $score++;

    return ['score' => $score, 'checks' => $checks];
}

// Обробка форми
$login = $_POST['login'] ?? 'dnipro_svitlana';
$action = $_POST['action'] ?? '';
$generated = '';
$strength = null;

if ($action === 'generate') {
    $generated = generateSecurePassword(15, $login);
    $strength = checkStrength($generated);
}

ob_start();
?>
<style>
    .strength-meter { height: 10px; background: #eee; border-radius: 5px; margin: 10px 0; overflow: hidden; }
    .strength-fill { height: 100%; transition: width 0.5s; }
    .score-1 { width: 20%; background: #ff4d4f; }
    .score-2 { width: 40%; background: #ff7a45; }
    .score-3 { width: 60%; background: #ffc53d; }
    .score-4 { width: 80%; background: #bae637; }
    .score-5 { width: 100%; background: #52c41a; }
    .demo-tag { padding: 2px 8px; border-radius: 4px; font-size: 0.85em; font-weight: bold; }
    .tag-success { background: #f6ffed; color: #52c41a; border: 1px solid #b7eb8f; }
    .tag-error { background: #fff1f0; color: #f5222d; border: 1px solid #ffa39e; }
</style>

<div class="demo-card">
    <h2>Генератор паролів (Варіант 8)</h2>
    <p class="demo-subtitle">Довжина 15, контроль спецсимволів та логіну</p>

    <form method="post" class="demo-form">
        <input type="hidden" name="action" value="generate">
        <div style="margin-bottom: 15px;">
            <label for="login">Логін (для перевірки виключення підрядків):</label>
            <input type="text" id="login" name="login" value="<?= htmlspecialchars($login) ?>">
        </div>
        <button type="submit" class="btn-submit">Згенерувати надійний пароль</button>
    </form>

    <?php if ($generated): ?>
    <div class="demo-result" style="margin-top: 25px; padding: 20px; border: 1px solid #d9d9d9; border-radius: 8px; background: #fafafa;">
        <h3>Ваш пароль:</h3>
        <div style="font-family: monospace; font-size: 1.5em; color: #000; letter-spacing: 2px; background: #fff; padding: 10px; border: 1px dashed #3498db; text-align: center;">
            <?= htmlspecialchars($generated) ?>
        </div>

        <div style="margin-top: 20px;">
            <strong>Складність: <?= $strength['score'] ?>/5</strong>
            <div class="strength-meter">
                <div class="strength-fill score-<?= $strength['score'] ?>"></div>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <?php foreach ($strength['checks'] as $check): ?>
            <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 8px 0;"><?= $check['label'] ?></td>
                <td style="text-align: right;">
                    <span class="demo-tag <?= $check['passed'] ? 'tag-success' : 'tag-error' ?>">
                        <?= $check['passed'] ? 'Виконано' : 'Немає' ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <p style="font-size: 0.85em; color: #666; margin-top: 15px;">
            * Пароль перегенеровано автоматично, якщо він містив більше 2 символів з логіну "<?= htmlspecialchars($login) ?>".
        </p>
    </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
renderLayout($content, 'Завдання 5');