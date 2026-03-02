<?php
/**
 * Завдання 3: Ім'я файлу
 *
 * Варіант 8: "D:\University\Labs\database.xlsx"
 */
require_once __DIR__ . '/layout.php';

/**
 * Виділяє ім'я файлу без розширення
 */
function extractFilename(string $path): string
{
    // Замінюємо зворотні слеші на прямі для кросплатформності
    $basename = basename(str_replace('\\', '/', $path));
    $dotPos = strrpos($basename, '.');
    if ($dotPos !== false) {
        return substr($basename, 0, $dotPos);
    }
    return $basename;
}

/**
 * Виділяє розширення файлу
 */
function extractExtension(string $path): string
{
    $basename = basename(str_replace('\\', '/', $path));
    $dotPos = strrpos($basename, '.');
    if ($dotPos !== false) {
        return substr($basename, $dotPos + 1);
    }
    return '';
}

/**
 * Виділяє шлях до директорії
 */
function extractDirectory(string $path): string
{
    // Використовуємо pathinfo для коректної обробки Windows-шляхів
    return pathinfo($path, PATHINFO_DIRNAME);
}

// Вхідні дані (варіант 8)
$defaultPath = 'D:\University\Labs\database.xlsx';
$path = $_POST['path'] ?? $defaultPath;
$submitted = isset($_POST['path']);

$filename = extractFilename($path);
$extension = extractExtension($path);
$directory = extractDirectory($path);

ob_start();
?>
<div class="demo-card">
    <h2>Розбір шляху до файлу</h2>
    <p class="demo-subtitle">Виділення директорії, імені та розширення (Варіант 8)</p>

    <form method="post" class="demo-form">
        <div style="margin-bottom: 15px;">
            <label for="path">Повний шлях до файлу</label>
            <input type="text" id="path" name="path" value="<?= htmlspecialchars($path) ?>" 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-family: monospace;">
        </div>
        <button type="submit" class="btn-submit" 
                style="background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Виконати розбір
        </button>
    </form>

    <div class="demo-section" style="margin-top: 25px;">
        <h3>Результати розбору</h3>
        <table class="demo-table" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 10px; font-weight: bold; width: 150px;">Директорія:</td>
                <td style="padding: 10px; color: #666;"><code><?= htmlspecialchars($directory) ?></code></td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 10px; font-weight: bold;">Ім'я файлу:</td>
                <td style="padding: 10px;">
                    <span style="background: #eafff0; color: #27ae60; padding: 4px 10px; border-radius: 4px; font-weight: bold; border: 1px solid #27ae60;">
                        <?= htmlspecialchars($filename) ?>
                    </span>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 10px; font-weight: bold;">Розширення:</td>
                <td style="padding: 10px;">
                    <span style="background: #e8f4fd; color: #3498db; padding: 4px 10px; border-radius: 4px; font-weight: bold; border: 1px solid #3498db;">
                        <?= htmlspecialchars($extension) ?>
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div class="demo-code" style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px; font-family: monospace; font-size: 0.85em; border-left: 4px solid #3498db;">
        // Використано функції: basename(), pathinfo() та str_replace()<br>
        <strong>Шлях:</strong> <?= htmlspecialchars($path) ?>
    </div>
</div>
<?php
$content = ob_get_clean();

// Рендеримо через вашу функцію
if (function_exists('renderLayout')) {
    renderLayout($content, 'Завдання 3 — Імʼя файлу');
} else {
    renderVariantLayout($content, 'Завдання 3');
}