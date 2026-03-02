<?php
/**
 * Завдання 11: Результати обчислень
 * Варіант 8: X = 7, Y = 3
 */
require_once __DIR__ . '/layout.php';

// --- Математичне ядро ---

function my_sin(float $x): float { return sin($x); }
function my_cos(float $x): float { return cos($x); }
function my_tan(float $x): float { return tan($x); }

function my_tg_custom(float $x): string|float {
    $c = cos($x);
    if (abs($c) < 1e-10) return 'Помилка: ділення на 0';
    return sin($x) / $c;
}

function my_pow(float $x, float $y): float { return pow($x, $y); }

function my_factorial(int $n): string|int {
    if ($n < 0) return 'Не визначено';
    if ($n > 20) return 'Завелике число';
    return ($n <= 1) ? 1 : $n * my_factorial($n - 1);
}

// --- Обробка даних ---
$x = isset($_POST['x']) ? (float)$_POST['x'] : 7.0;
$y = isset($_POST['y']) ? (float)$_POST['y'] : 3.0;

$results = [
    ['name' => 'sin',   'expr' => "sin($x)",          'val' => my_sin($x)],
    ['name' => 'cos',   'expr' => "cos($x)",          'val' => my_cos($x)],
    ['name' => 'tg',    'expr' => "tan($x)",          'val' => my_tan($x)],
    ['name' => 'my_tg', 'expr' => "sin($x)/cos($x)",  'val' => my_tg_custom($x)],
    ['name' => 'Степінь','expr' => "$x^$y",           'val' => my_pow($x, $y)],
    ['name' => 'Факторіал','expr' => (int)$x . "!",   'val' => my_factorial((int)$x)],
];

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Результати обчислень</h2>
    
    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
        <div style="background: #e8f4fd; padding: 10px 20px; border-radius: 4px; border-left: 4px solid #3498db;">
            <strong>X = <?= $x ?></strong>
        </div>
        <div style="background: #e8f4fd; padding: 10px 20px; border-radius: 4px; border-left: 4px solid #3498db;">
            <strong>Y = <?= $y ?></strong>
        </div>
    </div>

    <table class="demo-table" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 12px; text-align: left;">Функція</th>
                <th style="padding: 12px; text-align: left;">Вираз</th>
                <th style="padding: 12px; text-align: left;">Результат</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r): ?>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px; font-weight: bold; color: #555;"><?= $r['name'] ?></td>
                <td style="padding: 12px; font-family: monospace;"><?= $r['expr'] ?></td>
                <td style="padding: 12px;">
                    <?php if (is_string($r['val'])): ?>
                        <span style="color: red;"><?= $r['val'] ?></span>
                    <?php else: ?>
                        <span style="font-weight: bold; color: #2c3e50;"><?= round($r['val'], 4) ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 25px; display: flex; gap: 10px;">
        <a href="task11_calc.php?x=<?= $x ?>&y=<?= $y ?>" 
           style="text-decoration: none; background: #95a5a6; color: white; padding: 8px 15px; border-radius: 4px;">Повернутися</a>
        <a href="task11_calc.php" 
           style="text-decoration: none; background: #3498db; color: white; padding: 8px 15px; border-radius: 4px;">Скинути</a>
    </div>

    <div class="demo-code" style="margin-top: 20px; padding: 15px; background: #2c3e50; color: #ecf0f1; border-radius: 4px; font-family: monospace; font-size: 0.9em;">
        // PHP Math Logic for X=<?= $x ?>, Y=<?= $y ?><br>
        pow(<?= $x ?>, <?= $y ?>) = <?= pow($x, $y) ?><br>
        factorial(<?= (int)$x ?>) = <?= $results[5]['val'] ?>
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 11 — Результати');