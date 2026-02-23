<?php
/**
 * Завдання 4: Голосна чи приголосна (українська літера, switch)
 *
 * Літера 'д' → "приголосна"
 */
require_once __DIR__ . '/layout.php';

function isVowelOrConsonant(string $letter): string
{
    $vowels = ['а', 'е', 'є', 'и', 'і', 'ї', 'о', 'у', 'ю', 'я'];
    $letter = strtolower($letter);
    return in_array($letter, $vowels, true) ? "голосна" : "приголосна";
}

// Вхідні дані (варіант 8)
$letter = 'д';

$result = isVowelOrConsonant($letter);
$isVowel = $result === "голосна";

$color = $isVowel ? "#10b981" : "#8b5cf6";
$emoji = $isVowel ? "🔊" : "🔇";

$content = '<div class="card large">
    <div class="letter-display" style="color:' . $color . '">' . $letter . '</div>
    <div class="letter-emoji" style="color:' . $color . '">' . $emoji . '</div>
    <div class="letter-result">
        Літера <strong>\'' . $letter . '\'</strong> — <span style="color:' . $color . '">' . $result . '</span>
    </div>
    <p class="info">isVowelOrConsonant(\'' . $letter . '\') = "' . $result . '"</p>
</div>';

renderVariantLayout($content, 'Завдання 4', 'task5-body');
