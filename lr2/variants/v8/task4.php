<?php
/**
 * Завдання 4: Різниця дат
 * * Варіант 8: 25-06-2024 та 01-02-2025
 */
require_once __DIR__ . '/layout.php';

/**
 * Обчислює різницю між двома датами у днях
 */
function dateDifference(string $date1, string $date2): int|false
{
    $d1 = DateTime::createFromFormat('d-m-Y', $date1);
    $d2 = DateTime::createFromFormat('d-m-Y', $date2);

    if (!$d1 || !$d2) {
        return false;
    }

    $interval = $d1->diff($d2);
    return $interval->days;
}

/**
 * Перевірка валідності дати
 */
function isValidDate(string $date): bool
{
    $d = DateTime::createFromFormat('d-m-Y', $date);
    return $d && $d->format('d-m-Y') === $date;
}

/**
 * Повертає назву дня тижня українською
 */
function getWeekdayUkrainian(string $date): string
{
    $days = [
        'Monday'    => 'понеділок',
        'Tuesday'   => 'вівторок',
        'Wednesday' => 'середа',
        'Thursday'  => 'четвер',
        'Friday'    => 'п\'ятниця',
        'Saturday'  => 'субота',
        'Sunday'    => 'неділя',
    ];
    $d = DateTime::createFromFormat('d-m-Y', $date);
    if (!$d) return '';
    
    return $days[$d->format('l')] ?? '';
}

// Вхідні дані (варіант 8)
$date1 = $_POST['date1'] ?? '25-06-2024';
$date2 = $_POST['date2'] ?? '01-02-2025';
$submitted = isset($_POST['date1']);

$error = '';
$days = null;

if ($submitted) {
    if (!isValidDate($date1)) {
        $error = "Перша дата невірна (ДД-ММ-РРРР)";
    } elseif (!isValidDate($date2)) {
        $error = "Друга дата невірна (ДД-ММ-РРРР)";
    } else {
        $days = dateDifference($date1, $date2);
    }
} else {
    // Автоматичний розрахунок для відображення очікуваного результату
    $days = dateDifference($date1, $date2);
    $submitted = true;
}

ob_start();
?>
<div class="demo-card">
    <h2>Різниця дат</h2>
    <p class="demo-subtitle">Обчислення інтервалу та визначення днів тижня (Варіант 8)</p>

    <form method="post" class="demo-form">
        <div style="display: flex; gap: 20px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label for="date1">Дата 1</label>
                <input type="text" id="date1" name="date1" value="<?= htmlspecialchars($date1) ?>" style="width: 100%; padding: 8px;">
            </div>
            <div style="flex: 1;">
                <label for="date2">Дата 2</label>
                <input type="text" id="date2" name="date2" value="<?= htmlspecialchars($date2) ?>" style="width: 100%; padding: 8px;">
            </div>
        </div>
        <button type="submit" class="btn-submit" style="background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Обчислити</button>
    </form>

    <?php if ($error): ?>
    <div class="demo-result" style="background: #fff1f0; border: 1px solid #ffa39e; padding: 15px; margin-top: 20px;">
        <h3 style="color: #cf1322; margin-top: 0;">Помилка</h3>
        <div><?= htmlspecialchars($error) ?></div>
    </div>
    <?php elseif ($days !== null): ?>
    <div class="demo-result" style="background: #e8f4fd; border-left: 5px solid #3498db; padding: 20px; margin-top: 25px;">
        <h3 style="margin-top: 0;">Результат: <?= $days ?> днів</h3>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr style="border-bottom: 1px solid #ddecfa;">
                <td style="padding: 8px 0;"><strong>Дата 1 (<?= htmlspecialchars($date1) ?>):</strong></td>
                <td style="padding: 8px 0; text-align: right;"><span style="color: #3498db; font-weight: bold;"><?= getWeekdayUkrainian($date1) ?></span></td>
            </tr>
            <tr style="border-bottom: 1px solid #ddecfa;">
                <td style="padding: 8px 0;"><strong>Дата 2 (<?= htmlspecialchars($date2) ?>):</strong></td>
                <td style="padding: 8px 0; text-align: right;"><span style="color: #3498db; font-weight: bold;"><?= getWeekdayUkrainian($date2) ?></span></td>
            </tr>
        </table>
    </div>

    <div class="demo-code" style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px; font-family: monospace; font-size: 0.85em;">
        // Очікуваний результат: <?= $days ?> днів<br>
        // Дні тижня: <?= getWeekdayUkrainian($date1) ?> — <?= getWeekdayUkrainian($date2) ?>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();

if (function_exists('renderLayout')) {
    renderLayout($content, 'Завдання 4 — Різниця дат');
} else {
    renderVariantLayout($content, 'Завдання 4');
}