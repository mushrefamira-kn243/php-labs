<?php
/**
 * Завдання 2: Сортування міст
 *
 * Варіант 8: sort — за алфавітом (А-Я)
 */
require_once __DIR__ . '/layout.php';

/**
 * Сортує міста у алфавітному порядку
 */
function sortCitiesAlphabetically(string $input): array
{
    // Розбиваємо рядок, прибираємо зайві пробіли та пусті елементи
    $cities = array_filter(array_map('trim', explode(' ', $input)));
    // Сортування за алфавітом (А-Я)
    sort($cities);
    return $cities;
}

// Вхідні дані (варіант 8)
$defaultCities = 'Суми Конотоп Шостка Ромни Глухів Тростянець Лебедин Охтирка';
$input = $_POST['cities'] ?? $defaultCities;
$submitted = isset($_POST['cities']);

$sorted = sortCitiesAlphabetically($input);

ob_start();
?>
<div class="demo-card">
    <h2>Сортування міст</h2>
    <p class="demo-subtitle">Варіант 8: Введіть назви міст через пробіл — сортування від А до Я</p>

    <form method="post" class="demo-form">
        <div style="margin-bottom: 15px;">
            <label for="cities">Міста (через пробіл)</label>
            <input type="text" id="cities" name="cities" value="<?= htmlspecialchars($input) ?>" 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <button type="submit" class="btn-submit" 
                style="background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Відсортувати
        </button>
    </form>

    <?php if (!empty($sorted)): ?>
    <div class="demo-section" style="margin-top: 25px;">
        <h3>Вхідні дані</h3>
        <div class="array-display" style="display: flex; flex-wrap: wrap; gap: 8px;">
            <?php 
            $originalArray = array_filter(array_map('trim', explode(' ', $input)));
            foreach ($originalArray as $city): ?>
                <span class="array-item" style="background: #eee; padding: 5px 12px; border-radius: 15px; font-size: 0.9em;">
                    <?= htmlspecialchars($city) ?>
                </span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow" style="font-size: 24px; text-align: center; margin: 15px 0; color: #3498db;">&#8595;</div>

    <div>
        <h3 class="demo-section-title-success" style="color: #27ae60;">Результат (А→Я)</h3>
        <div class="array-display" style="display: flex; flex-wrap: wrap; gap: 8px;">
            <?php foreach ($sorted as $city): ?>
                <span class="array-item array-item-unique" 
                      style="background: #eafff0; border: 1px solid #27ae60; color: #27ae60; padding: 5px 12px; border-radius: 15px; font-size: 0.9em; font-weight: bold;">
                    <?= htmlspecialchars($city) ?>
                </span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code" style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px; font-family: monospace; font-size: 0.85em; border-left: 4px solid #3498db;">
        // Використано функцію sort() для масиву міст<br>
        <strong>Очікуваний результат:</strong> <?= htmlspecialchars(implode(', ', $sorted)) ?>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();

// Викликаємо функцію рендеру, яка визначена у вашому layout.php
if (function_exists('renderLayout')) {
    renderLayout($content, 'Завдання 2 — Сортування міст');
} else {
    renderVariantLayout($content, 'Завдання 2');
}