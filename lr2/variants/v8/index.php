<?php

require_once dirname(__DIR__, 3) . '/shared/templates/task_cards.php';
require_once dirname(__DIR__, 3) . '/shared/helpers/paths.php';

$tasks = [
    'task1.php' => ['name' => 'Завдання 1'],
    'task2.php' => ['name' => 'Завдання 2'],
    'task3.php' => ['name' => 'Завдання 3'],
    'task4.php' => ['name' => 'Завдання 4'],
    'task5.php' => ['name' => 'Завдання 5'],
    'task6.php' => ['name' => 'Завдання 6'],
    'task7.php' => ['name' => 'Завдання 7'],
    'task8.php' => ['name' => 'Завдання 8'],
    'task9.php' => ['name' => 'Завдання 9'],
    'task10_form.php' => ['name' => 'Завдання 10'],
    'task11_calc.php' => ['name' => 'Завдання 11'],
];

$demoUrl = '/lr2/demo/index.php?from=v8';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Варіант 8 — ЛР2</title>
    <link rel="stylesheet" href="<?= webPath(dirname(__DIR__, 3) . '/shared/css/base.css') ?>">
    <link rel="stylesheet" href="<?= webPath(dirname(__DIR__, 2) . '/demo/demo.css') ?>">
</head>
<body class="index-page">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right">
            Варіант 8 ЛР2
        </div>
    </header>

    <h1 class="index-title">
        Варіант 8
        <br><span class="index-subtitle">Лабораторна робота №2</span>
    </h1>

    <?= renderTaskCards($tasks, true, $demoUrl) ?>
</body>
</html>
