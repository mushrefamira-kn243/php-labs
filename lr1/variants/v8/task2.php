<?php
$uah = 6350;

$usd_rate = 38.20;

$usd = $uah / $usd_rate;

$usd_formatted = number_format($usd, 2);

echo "{$uah} грн. можна обміняти на {$usd_formatted} долар";
?>
