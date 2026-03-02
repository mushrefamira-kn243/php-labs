<?php
/**
 * Завдання 8: Операції з масивами
 *
 * Варіант 8: Об'єднання (array_merge) + унікальність (array_unique) + сортування (sort)
 * createArray(): довжина 3-7, значення 10-20
 */
require_once __DIR__ . '/layout.php';

/**
 * Створює масив випадкової довжини (3-7) з випадковими значеннями (10-20)
 */
function createArray(): array
{
    $length = random_int(3, 7);
    $arr = [];
    for ($i = 0; $i < $length; $i++) {
        $arr[] = random_int(10, 20);
    }
    return $arr;
}

/**
 * Об'єднує два масиви, видаляє дублікати та сортує за зростанням
 */
function mergeUniqueSorted(array $a, array $b): array
{
    // 1. Об'єднуємо масиви
    $merged = array_merge($a, $b);
    // 2. Видаляємо дублікати
    $unique = array_unique($merged);
    // 3. Сортуємо за зростанням
    sort($unique);
    
    return array_values($unique);
}

// Генеруємо масиви для демонстрації
$arr1 = createArray();
$arr2 = createArray();

$result = mergeUniqueSorted($arr1, $arr2);

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Операції з масивами</h2>
    <p class="demo-subtitle">Варіант 8: Об'єднання → Унікальні значення → Сортування за зростанням</p>

    <form method="post" class="demo-form">
        <button type="submit" name="regenerate" class="btn-submit" 
                style="background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Згенерувати нові масиви
        </button>
    </form>

    <div class="demo-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
        <div class="demo-panel" style="background: #fdfdfd; padding: 15px; border: 1px solid #eee; border-radius: 8px;">
            <h3 style="margin-top: 0; font-size: 1rem; color: #666;">Масив 1 (довжина: <?= count($arr1) ?>)</h3>
            <div class="array-display" style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php foreach ($arr1 as $v): ?>
                <span class="array-item" style="background: #eee; padding: 4px 10px; border-radius: 4px;"><?= $v ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="demo-panel" style="background: #fdfdfd; padding: 15px; border: 1px solid #eee; border-radius: 8px;">
            <h3 style="margin-top: 0; font-size: 1rem; color: #666;">Масив 2 (довжина: <?= count($arr2) ?>)</h3>
            <div class="array-display" style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php foreach ($arr2 as $v): ?>
                <span class="array-item" style="background: #eee; padding: 4px 10px; border-radius: 4px;"><?= $v ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="array-arrow" style="text-align: center; font-size: 24px; margin: 20px 0; color: #3498db;">
        &#8595; Злиття та обробка
    </div>

    <div style="background: #eafff0; border: 1px solid #27ae60; padding: 20px; border-radius: 8px;">
        <h3 class="demo-section-title-success" style="margin-top: 0; color: #27ae60;">Результат (Sorted & Unique)</h3>
        <div class="array-display" style="display: flex; flex-wrap: wrap; gap: 10px;">
            <?php foreach ($result as $v): ?>
            <span class="array-item array-item-unique" 
                  style="background: #27ae60; color: white; padding: 6px 12px; border-radius: 20px; font-weight: bold;">
                <?= $v ?>
            </span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code" style="margin-top: 25px; padding: 15px; background: #f8f9fa; border-left: 4px solid #3498db; font-family: monospace; font-size: 0.85em; line-height: 1.6;">
        // Логіка обробки:<br>
        $merged = array_merge($a, $b);<br>
        $unique = array_unique($merged);<br>
        sort($unique);<br><br>
        // Поточні масиви:<br>
        $a = [<?= implode(', ', $arr1) ?>];<br>
        $b = [<?= implode(', ', $arr2) ?>];<br>
        // Результат: [<?= implode(', ', $result) ?>]
    </div>
</div>
<?php
$content = ob_get_clean();

// Рендеримо сторінку
if (function_exists('renderLayout')) {
    renderLayout($content, 'Завдання 8 — Операції з масивами');
} else {
    renderVariantLayout($content, 'Завдання 8');
}