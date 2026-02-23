<?php
/**
 * Завдання 6.2: 9 червоних квадратів на чорному тлі
 */
require_once __DIR__ . '/layout.php';

function generateRedSquaresHtml(int $n): string
{
    $html = "<div class='shapes-container shapes-container--dark'>";

    for ($i = 0; $i < $n; $i++) {
        $size = 20 + $i * 10;
        $top = mt_rand(5, 85);
        $left = mt_rand(5, 85);
        $opacity = mt_rand(70, 100) / 100;

        $html .= "<div style='
            position:absolute;
            top:{$top}%;
            left:{$left}%;
            width:{$size}px;
            height:{$size}px;
            background-color:#ef4444;
            opacity:{$opacity};
            border-radius:4px;
        '></div>";
    }

    $html .= "</div>";
    return $html;
}

$n = 9;
$squares = generateRedSquaresHtml($n);

$content = $squares . '
    <div class="circles-func">generateRedSquaresHtml(' . $n . ')</div>
    <div class="circles-counter">🟥 Квадратів: ' . $n . '</div>
    <p class="circles-info">Оновіть сторінку для нової композиції 🔄</p>';

renderVariantLayout($content, 'Завдання 6.2', 'task7-circles-body');
