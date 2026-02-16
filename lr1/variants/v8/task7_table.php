<?php
/**
 * Завдання 6.1: Таблиця 4x8 різнокольорова (варіант 8)
 */
require_once __DIR__ . '/layout.php';

function generateColorTableHtml(int $rows, int $cols): string
{
    $html = "<table border='1' style='border-collapse:collapse;margin-bottom:20px;'>";
    for ($i = 0; $i < $rows; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='width:50px;height:50px;background-color:{$color};'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$rows = 4;
$cols = 8;
$table = generateColorTableHtml($rows, $cols);

$content = '<div class="card">' .
    '<h1 style="color:black;">🎨  Кольорова таблиця   ' . $rows . 'x' . $cols . '</h1>' .
    "<div class=\"params\">generateColorTableHtml({$rows}, {$cols})</div>" .
    $table .
    '</div>';

renderVariantLayout($content, 'Завдання 6.1', 'task7-table-body');
