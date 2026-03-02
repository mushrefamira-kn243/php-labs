<?php
/**
 * Завдання 11: Калькулятор — форма введення
 * Варіант 8: X = 7, Y = 3
 */
require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="demo-card">
    <h2>Калькулятор функцій</h2>
    <p class="demo-subtitle">Обчислення тригонометричних функцій, степеня та факторіала</p>

    <form method="post" action="task11_result.php" class="demo-form">
        <div class="form-row" style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label for="x" style="display: block; font-weight: bold; margin-bottom: 5px;">Значення X</label>
                <input type="number" id="x" name="x" step="any" value="<?= htmlspecialchars($_GET['x'] ?? '7') ?>" 
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>
            <div style="flex: 1;">
                <label for="y" style="display: block; font-weight: bold; margin-bottom: 5px;">Значення Y</label>
                <input type="number" id="y" name="y" step="any" value="<?= htmlspecialchars($_GET['y'] ?? '3') ?>" 
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>
        </div>
        <button type="submit" class="btn-submit" 
                style="background: #3498db; color: white; padding: 10px 25px; border: none; border-radius: 4px; cursor: pointer; width: 100%;">
            Обчислити результати
        </button>
    </form>

    <div class="demo-section" style="margin-top: 25px;">
        <h3>Математичний опис</h3>
        <ul style="line-height: 1.8;">
            <li><strong>Тригонометрія:</strong> Обчислення в радіанах ($sin, cos, tan$).</li>
            <li><strong>Власна функція:</strong> $my\_tg(x)$ як відношення синуса до косинуса.</li>
            <li><strong>Алгебра:</strong> Піднесення до степеня $x^y$.</li>
            <li><strong>Комбінаторика:</strong> Рекурсивне обчислення факторіала $x!$.</li>
        </ul>
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 11');