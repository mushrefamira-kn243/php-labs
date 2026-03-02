<?php
require_once 'layout.php'; // Підключаємо ваш файл із функцією renderLayout

// 1. Вихідні дані згідно з варіантом 8
$originalText = "Вишиванка є символом української ідентичності кожен візерунок несе глибокий зміст та передає мудрість предків";
$search = "е";
$replace = "а";

/**
 * Виконуємо заміну. 
 * У вашому прикладі "є" (євро-є) не замінюється, а замінюється лише "е".
 * str_replace чутлива до регістру та різних символів кирилиці.
 */
$resultText = str_replace($search, $replace, $originalText);

// 2. Формуємо контент для відображення
ob_start(); 
?>

<div class="task-container">
    <p><strong>Умова завдання:</strong> Створити програму, яка знаходить у заданому тексті всі літери "<?= $search ?>" та замінює їх на "<?= $replace ?>".</p>
    
    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

    <h3>Вихідний текст:</h3>
    <blockquote style="font-style: italic; color: #555; background: #f9f9f9; padding: 10px; border-left: 4px solid #ccc;">
        "<?= $originalText ?>"
    </blockquote>

    <h3>Параметри заміни:</h3>
    <ul>
        <li><strong>Шукаємо:</strong> <span style="color: red; font-weight: bold;"><?= $search ?></span></li>
        <li><strong>Замінюємо на:</strong> <span style="color: green; font-weight: bold;"><?= $replace ?></span></li>
    </ul>

    <h3>Отриманий результат:</h3>
    <div class="result-box">
        <?= $resultText ?>
    </div>
    
    <p style="font-size: 0.9em; color: #666;">
        * Примітка: Літера "є" (українська) залишилася без змін, оскільки ми шукали саме "е".
    </p>
</div>

<?php
$content = ob_get_clean();

// 3. Рендеримо сторінку, використовуючи стиль "30 варіанту"
renderLayout($content, "Завдання 1 — Пошук та заміна");