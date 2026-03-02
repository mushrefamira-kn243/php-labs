<?php
/**
 * Завдання 1: Пошук та заміна
 * * Варіант 8: "е" → "а"
 */
require_once __DIR__ . '/layout.php';

/**
 * Функція для пошуку та заміни підрядка
 */
function findAndReplace(string $text, string $find, string $replace): string
{
    if ($find === '') {
        return $text;
    }
    // Використовуємо str_replace для заміни всіх входжень
    return str_replace($find, $replace, $text);
}

// Вихідні дані згідно з варіантом 8
$defaultText = "Вишиванка є символом української ідентичності кожен візерунок несе глибокий зміст та передає мудрість предків";
$defaultFind = "е";
$defaultReplace = "а";

// Отримання даних з форми або встановлення значень за замовчуванням
$text = $_POST['text'] ?? $defaultText;
$find = $_POST['find'] ?? $defaultFind;
$replace = $_POST['replace'] ?? $defaultReplace;
$result = '';
$submitted = isset($_POST['text']);

if ($submitted) {
    if ($find !== '') {
        $result = findAndReplace($text, $find, $replace);
    }
} else {
    // Якщо форма ще не була відправлена, показуємо очікуваний результат за замовчуванням
    $result = findAndReplace($text, $find, $replace);
    $submitted = true; // Активуємо показ блоку результату для наочності
}

ob_start();
?>
<div class="demo-card">
    <h2>Знайти і замінити</h2>
    <p class="demo-subtitle">Завдання №1 — Варіант 8 (Кирилична заміна)</p>

    <form method="post" class="demo-form">
        <div>
            <label for="text">Текст</label>
            <textarea id="text" name="text" rows="3"><?= htmlspecialchars($text) ?></textarea>
        </div>
        <div class="form-row" style="display: flex; gap: 20px; margin-top: 15px;">
            <div style="flex: 1;">
                <label for="find">Знайти</label>
                <input type="text" id="find" name="find" value="<?= htmlspecialchars($find) ?>" style="width: 100%;">
            </div>
            <div style="flex: 1;">
                <label for="replace">Замінити на</label>
                <input type="text" id="replace" name="replace" value="<?= htmlspecialchars($replace) ?>" style="width: 100%;">
            </div>
        </div>
        <button type="submit" class="btn-submit" style="margin-top: 20px;">Виконати заміну</button>
    </form>

    <?php if ($submitted && $find !== ''): ?>
    <div class="demo-result" style="margin-top: 25px; padding: 15px; background: #f0f9ff; border-radius: 8px;">
        <h3 style="margin-top: 0;">Результат</h3>
        <div class="demo-result-value" style="font-size: 1.1em; line-height: 1.5; color: #2c3e50;">
            <?= htmlspecialchars($result) ?>
        </div>
    </div>
    <div class="demo-code" style="margin-top: 10px; font-family: monospace; color: #666; font-size: 0.9em;">
        str_replace("<?= htmlspecialchars($find) ?>", "<?= htmlspecialchars($replace) ?>", text)
    </div>
    <?php elseif ($submitted && $find === ''): ?>
    <div class="demo-result demo-result-error" style="margin-top: 25px; padding: 15px; background: #fff1f0; border-radius: 8px; border: 1px solid #ffa39e;">
        <h3 style="margin-top: 0; color: #cf1322;">Помилка</h3>
        <div class="demo-result-value">Поле "Знайти" не може бути порожнім</div>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();

// Викликаємо функцію рендеру (якщо у вашому файлі вона називається renderLayout, змініть назву тут)
if (function_exists('renderLayout')) {
    renderLayout($content, 'Завдання 1');
} else {
    renderVariantLayout($content, 'Завдання 1');
}