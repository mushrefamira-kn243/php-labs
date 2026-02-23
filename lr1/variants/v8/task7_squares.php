<?php
/**
 * Завдання 6.2: 9 червоних квадратів на чорному тлі (варіант 8)
 */
require_once __DIR__ . '/layout.php';

function generateRedSquaresHtml(int $n): string
{
    // make the drawing area larger so all squares fit reliably
    $containerWidth = 1200;   // px (max-width)
    $containerHeight = 600;   // px

    $html = "<div style='position:relative;width:100%;max-width:{$containerWidth}px;height:{$containerHeight}px;margin:0 auto;background-color:#000;overflow:hidden;'>";

    for ($i = 0; $i < $n; $i++) {
        $size = 20 + $i * 10; // last square = 20 + (n-1)*10 -> for n=9 => 100px
        $top = mt_rand(0, $containerHeight - $size);
        $left = mt_rand(0, $containerWidth - $size);
        $html .= "<div style='position:absolute;top:{$top}px;left:{$left}px;width:{$size}px;height:{$size}px;background:#ef4444;opacity:0.95;border-radius:4px;'></div>";
    }

    $html .= "</div>";
    return $html;
}

$n = 9;
$squares = generateRedSquaresHtml($n);

$content = '<div class="card">' .
    '<h2>🟥 ' . $n . ' червоних квадратів</h2>' .
    $squares .
    "<div class=\"circles-counter\">Квадратів: {$n}</div>" .
    '</div>';

renderVariantLayout($content, 'Завдання 6.2', 'task7-circles-body');
