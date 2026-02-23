<?php
/**
 * Завдання 6.1: Кольорова таблиця 4x8
 */
require_once __DIR__ . '/layout.php';

function generateColorTableHtml(int $rows, int $cols): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $rows; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='background-color:{$color};'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$rows = 4;
$cols = 8;
$table = generateColorTableHtml($rows, $cols);

$content = '
    <h1>🎨 Кольорова таблиця ' . $rows . 'x' . $cols . '</h1>
    <div class="params">generateColorTableHtml(' . $rows . ', ' . $cols . ')</div>
    ' . $table;

renderVariantLayout($content, 'Завдання 6.1', 'task7-table-body');
