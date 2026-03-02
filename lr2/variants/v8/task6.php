<?php
/**
 * Завдання 6: Пошук дублікатів
 *
 * Варіант 8: Масив [6, 18, 3, 12, 6, 18, 9, 3, 24, 12]
 */
require_once __DIR__ . '/layout.php';

/**
 * Знаходить елементи, які повторюються в масиві
 * * @param array $arr
 * @return array Унікальний список дублікатів
 */
function findDuplicates(array $arr): array
{
    // Рахуємо кількість входжень кожного елемента
    $counts = array_count_values($arr);
    
    // Фільтруємо ті, що зустрічаються більше 1 разу
    $duplicates = array_filter($counts, fn($count) => $count > 1);
    
    // Повертаємо тільки ключі (самі значення, що дублюються)
    return array_keys($duplicates);
}

// Вхідні дані (варіант 8)
$defaultInput = '6, 18, 3, 12, 6, 18, 9, 3, 24, 12';
$input = $_POST['array'] ?? $defaultInput;
$submitted = isset($_POST['array']);

// Перетворюємо рядок у масив чисел
$arr = array_map('trim', explode(',', $input));
$arr = array_filter($arr, fn($v) => $v !== '');

$duplicates = findDuplicates($arr);

ob_start();
?>
<div class="demo-card">
    <h2>Пошук дублікатів</h2>
    <p class="demo-subtitle">Варіант 8: Виявлення елементів, що повторюються в масиві</p>

    <form method="post" class="demo-form">
        <div style="margin-bottom: 15px;">
            <label for="array">Введіть числа через кому</label>
            <input type="text" id="array" name="array" value="<?= htmlspecialchars($input) ?>" placeholder="6, 18, 3, 12, ...">
        </div>
        <button type="submit" class="btn-submit">Знайти дублікати</button>
    </form>

    <?php if (!empty($arr)): ?>
    <div class="demo-section" style="margin-top: 25px;">
        <h3>Вхідний масив</h3>
        <div class="array-display" style="display: flex; flex-wrap: wrap; gap: 8px;">
            <?php foreach ($arr as $item): ?>
                <?php 
                    // Підсвічуємо елемент, якщо він є у списку дублікатів
                    $isDuplicate = in_array($item, $duplicates);
                ?>
                <span class="array-item" style="padding: 5px 12px; border-radius: 4px; border: 1px solid #ddd; <?= $isDuplicate ? 'background: #fff1f0; border-color: #ffa39e; color: #cf1322;' : 'background: #f5f5f5;' ?>">
                    <?= htmlspecialchars($item) ?>
                </span>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (!empty($duplicates)): ?>
    <div class="demo-result" style="margin-top: 25px; background: #e8f4fd; border-left: 5px solid #3498db; padding: 20px;">
        <h3 style="margin-top: 0;">Знайдені дублікати:</h3>
        <div class="demo-result-value" style="font-size: 1.2em; font-weight: bold; color: #2c3e50;">
            [<?= implode(', ', $duplicates) ?>]
        </div>
    </div>

    <div class="demo-section" style="margin-top: 20px;">
        <h3>Статистика повторень</h3>
        <table class="demo-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <th style="padding: 10px; text-align: left;">Число</th>
                    <th style="padding: 10px; text-align: left;">Кількість входжень</th>
                    <th style="padding: 10px; text-align: left;">Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $allCounts = array_count_values($arr);
                foreach ($allCounts as $val => $count):
                ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;"><?= htmlspecialchars($val) ?></td>
                    <td style="padding: 10px;"><?= $count ?></td>
                    <td style="padding: 10px;">
                        <?php if ($count > 1): ?>
                            <span style="background: #fff1f0; color: #cf1322; padding: 2px 8px; border-radius: 10px; font-size: 0.8em; border: 1px solid #ffa39e;">Дублікат</span>
                        <?php else: ?>
                            <span style="background: #f6ffed; color: #52c41a; padding: 2px 8px; border-radius: 10px; font-size: 0.8em; border: 1px solid #b7eb8f;">Унікальне</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="demo-result" style="background: #f6ffed; border-left: 5px solid #52c41a; padding: 20px; margin-top: 25px;">
        <h3 style="margin-top: 0; color: #52c41a;">Дублікатів не знайдено</h3>
        <div>Всі елементи масиву унікальні.</div>
    </div>
    <?php endif; ?>

    <div class="demo-code" style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px; font-family: monospace; font-size: 0.85em;">
        // Очікуваний результат: [6, 18, 3, 12]
        // findDuplicates([<?= htmlspecialchars(implode(', ', $arr)) ?>])
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();

if (function_exists('renderLayout')) {
    renderLayout($content, 'Завдання 6 — Пошук дублікатів');
} else {
    renderVariantLayout($content, 'Завдання 6');
}