<?php
/**
 * Завдання 4: Голосний чи приголосний (switch) — українська літера
 */
require_once __DIR__ . '/layout.php';

function isVowelOrConsonant(string $letter): string
{
    $l = mb_strtolower($letter, 'UTF-8');
    $vowels = ['а','е','є','и','і','ї','о','у','ю','я'];
    return in_array($l, $vowels, true) ? "голосна" : "приголосна";
}

$letter = 'д';
$result = isVowelOrConsonant($letter);
$isVowel = $result === "голосна";

$color = $isVowel ? "#10b981" : "#8b5cf6";
$emoji = $isVowel ? "🔊" : "🔇";

$content = '<div class="card large'>
    <div class="letter-display" style="color:' . $color . '">' . htmlspecialchars($letter) . '</div>' .
    "<div class=\"letter-emoji\" style=\"color:{$color}\">{$emoji}</div>" .
    "<div class=\"letter-result\">\n        Літера <strong>\'{$letter}\'</strong> — <span style=\"color:{$color}\">{$result}</span>\n    </div>" .
    "<p class=\"info\">isVowelOrConsonant('{$letter}') = \"{$result}\"</p>" .
    '</div>';

renderVariantLayout($content, 'Завдання 4', 'task5-body');
?>
