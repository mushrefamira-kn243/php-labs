<?php
/**
 * Простий шаблон для локальної папки з завданнями PHP
 */

function renderLayout(string $content, string $taskName, string $bodyClass = ''): void
{
    // Поточний файл
    $currentTask = basename($_SERVER['SCRIPT_NAME']);

    // Список твоїх завдань
    $tasks = [
        'index.php' => 'Завдання 1 — Форматований текст',
        'task2.php' => 'Завдання 2 — Конвертер валют',
        'task3.php' => 'Завдання 3 — Визначення сезону',
        'task4.php' => 'Завдання 4 — Голосний/Приголосний',
        'task5.php' => 'Завдання 5 — Тризначне число',
        'task6_table.php' => 'Завдання 6.1 — Таблиця',
        'task6_squares.php' => 'Завдання 6.2 — Квадрати',
    ];
    ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($taskName) ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        header { background: #333; color: white; padding: 10px; display: flex; align-items: center; justify-content: space-between; }
        header a { color: white; text-decoration: none; margin-right: 15px; }
        header select { padding: 3px; }
        .content-wrapper { padding: 20px; }
        table { border-collapse: collapse; margin-bottom: 20px; }
        td { width: 50px; height: 50px; }
        .square-container { position: relative; width: 600px; height: 300px; background-color: black; margin-bottom: 20px; }
        .square { position: absolute; background-color: red; }
    </style>
</head>
<body class="<?= htmlspecialchars($bodyClass) ?>">

<header>
    <div>
        <a href="#">Головна</a>
        <a href="<?= htmlspecialchars($currentTask) ?>">Поточне завдання</a>
    </div>
    <div>
        <select onchange="if(this.value) location.href=this.value">
            <?php foreach ($tasks as $file => $name): ?>
                <option value="<?= htmlspecialchars($file) ?>" <?= $file === $currentTask ? 'selected' : '' ?>>
                    <?= htmlspecialchars($name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</header>

<div class="content-wrapper">
    <?= $content ?>
</div>

</body>
</html>
<?php
}
