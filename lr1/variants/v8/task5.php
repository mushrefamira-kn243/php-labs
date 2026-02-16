<?php
$number = 639;

$hundreds = (int)($number / 100);
$tens = (int)(($number % 100) / 10);
$units = $number % 10;

$sum = $hundreds + $tens + $units;

$reversed = $units * 100 + $tens * 10 + $hundreds;

$digits = [$hundreds, $tens, $units];
rsort($digits);  
$max_number = $digits[0] * 100 + $digits[1] * 10 + $digits[2];

$is_palindrome = ($number == $reversed) ? "так" : "ні";

echo "Число: $number<br>";
echo "1. Сума цифр: $sum<br>";
echo "2. Зворотне число: $reversed<br>";
echo "3. Найбільше число з цифр: $max_number<br>";
echo "Паліндром: $is_palindrome";
?>
