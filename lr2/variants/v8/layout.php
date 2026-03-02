<?php
/**
 * Шаблон для Лабораторної роботи №2 (Варіант 8)
 */

function renderLayout(string $content, string $taskName, string $bodyClass = ''): void
{
    $currentTask = basename($_SERVER['SCRIPT_NAME']);

    // Оновлений список завдань для 2-ї лаби
    $tasks = [
        'index.php' => 'Завдання 1 — Пошук та заміна',
        'task2.php' => 'Завдання 2 — Сортування міст',
        'task3.php' => 'Завдання 3 — Шлях до файлу',
        'task4.php' => 'Завдання 4 — Різниця дат',
        'task5.php' => 'Завдання 5 — Генератор паролів',
        'task6.php' => 'Завдання 6 — Дублікати',
        'task7.php' => 'Завдання 7 — Імена тварин',
        'task8.php' => 'Завдання 8 — Операції з масивами',
        'task9.php' => 'Завдання 9 — Асоціативний масив',
        'task10.php' => 'Завдання 10 — Реєстрація',
        'task11.php' => 'Завдання 11 — Калькулятор функцій',
    ];
    ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($taskName) ?> | Варіант 8</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; padding: 0; background: #f0f2f5; color: #333; }
        header { background: #2c3e50; color: white; padding: 15px 25px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        header a { color: #ecf0f1; text-decoration: none; font-weight: bold; transition: 0.3s; }
        header a:hover { color: #3498db; }
        header select { padding: 5px; border-radius: 4px; border: none; outline: none; cursor: pointer; }
        
        .content-wrapper { max-width: 1000px; margin: 30px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        
        h2 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-top: 0; }
        .result-box { background: #e8f4fd; border-left: 5px solid #3498db; padding: 15px; margin: 20px 0; font-family: monospace; }
        
        /* Стилі для завдань з формами */
        form { display: grid; gap: 15px; max-width: 500px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"], select, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #2980b9; }
        
        /* Таблиці */
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table th, table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        table th { background-color: #f8f9fa; }
        
        /* Мова (Завдання 10) */
        .lang-switch { display: flex; gap: 10px; margin-bottom: 20px; }
        .lang-switch img { width: 30px; cursor: pointer; transition: transform 0.2s; }
        .lang-switch img:hover { transform: scale(1.1); }
    </style>
</head>
<body class="<?= htmlspecialchars($bodyClass) ?>">

<header>
    <div>
        <a href="index.php">Лабораторна №2</a>
        <span style="margin: 0 15px; opacity: 0.5;">|</span>
        <a href="#"><?= htmlspecialchars($taskName) ?></a>
    </div>
    <div>
        <select onchange="if(this.value) location.href=this.value">
            <option value="">Оберіть завдання...</option>
            <?php foreach ($tasks as $file => $name): ?>
                <option value="<?= htmlspecialchars($file) ?>" <?= $file === $currentTask ? 'selected' : '' ?>>
                    <?= htmlspecialchars($name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</header>

<div class="content-wrapper">
    <h2><?= htmlspecialchars($taskName) ?></h2>
    <?= $content ?>
</div>

</body>
</html>
<?php
}