<?php
/**
 * Завдання 2: Конвертер валют (UAH → USD)
 *
 * 6350 грн → доларів, курс 38.20
 */
require_once __DIR__ . '/layout.php';

function convertUahToUsd(float $uah, float $rate): float
{
    return round($uah / $rate, 2);
}

// Вхідні дані (варіант 8)
$uah = 6350;
$rate = 38.20;

$usd = convertUahToUsd($uah, $rate);

$content = '<div class="card">
    <h2>💵 Конвертер UAH → USD</h2>
    <p><strong>Курс:</strong> 1 USD = ' . $rate . ' грн</p>
    <div class="result">' . $uah . ' грн = <strong>' . $usd . '</strong> доларів</div>
    <p class="info">convertUahToUsd(' . $uah . ', ' . $rate . ') = ' . $usd . '</p>
</div>';

renderVariantLayout($content, 'Завдання 2', 'task3-body');
