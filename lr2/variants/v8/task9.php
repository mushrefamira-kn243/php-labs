<?php
/**
 * Завдання 9: Асоціативний масив
 *
 * Варіант 8: ім'я => вік
 * Сортування: ksort (за іменем), asort (за віком)
 */
require_once __DIR__ . '/layout.php';

/**
 * Сортує асоціативний масив за іменами (ключами)
 */
function sortByName(array $people): array
{
    ksort($people);
    return $people;
}

/**
 * Сортує асоціативний масив за віком (значеннями)
 */
function sortByAge(array $people): array
{
    asort($people);
    return $people;
}

// Вхідні дані (варіант 8)
$people = [
    "Данило" => 30,
    "Оля" => 54,
    "Кирило" => 19,
    "Інна" => 41,
    "Федір" => 26,
    "Злата" => 37,
];

// Обробка сортування
$sortBy = $_POST['sort'] ?? 'name';
$sorted = ($sortBy === 'age') ? sortByAge($people) : sortByName($people);

ob_start();
?>
<div class="demo-card">
    <h2>Асоціативний масив</h2>
    <p class="demo-subtitle">Сортування списку людей за ключем (ім'я) або значенням (вік)</p>

    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
        <form method="post">
            <input type="hidden" name="sort" value="name">
            <button type="submit" 
                    style="background: <?= $sortBy === 'name' ? '#3498db' : '#ecf0f1' ?>; 
                           color: <?= $sortBy === 'name' ? 'white' : '#333' ?>; 
                           padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                За іменем (ksort)
            </button>
        </form>
        <form method="post">
            <input type="hidden" name="sort" value="age">
            <button type="submit" 
                    style="background: <?= $sortBy === 'age' ? '#3498db' : '#ecf0f1' ?>; 
                           color: <?= $sortBy === 'age' ? 'white' : '#333' ?>; 
                           padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                За віком (asort)
            </button>
        </form>
    </div>

    <div class="demo-section">
        <h3>Вхідні дані</h3>
        <div class="demo-code" style="background: #f8f9fa; padding: 15px; border-radius: 4px; font-family: monospace;">
            $people = [<br>
            <?php foreach ($people as $name => $age): ?>
                &nbsp;&nbsp;"<?= $name ?>" => <?= $age ?>,<br>
            <?php endforeach; ?>
            ];
        </div>
    </div>

    <div class="demo-section" style="margin-top: 25px;">
        <h3>Результат: <span style="color: #3498db;"><?= $sortBy === 'age' ? 'сортування за віком' : 'сортування за іменем' ?></span></h3>
        <table class="demo-table" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="background: #f4f7f6; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #3498db;">№</th>
                    <th style="padding: 12px; border-bottom: 2px solid #3498db;">Ім'я <?= $sortBy === 'name' ? '↓' : '' ?></th>
                    <th style="padding: 12px; border-bottom: 2px solid #3498db;">Вік <?= $sortBy === 'age' ? '↓' : '' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($sorted as $name => $age): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;"><?= $i++ ?></td>
                    <td style="padding: 10px; font-weight: bold;"><?= htmlspecialchars($name) ?></td>
                    <td style="padding: 10px;">
                        <span style="background: #e8f4fd; color: #3498db; padding: 4px 12px; border-radius: 12px; font-size: 0.9em;">
                            <?= $age ?> років
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="demo-code" style="margin-top: 20px; font-style: italic; color: #666;">
        // Використано функцію: <?= $sortBy === 'age' ? 'asort($people)' : 'ksort($people)' ?>
    </div>
</div>
<?php
$content = ob_get_clean();

if (function_exists('renderLayout')) {
    renderLayout($content, 'Завдання 9 — Асоціативний масив');
} else {
    renderVariantLayout($content, 'Завдання 9');
}