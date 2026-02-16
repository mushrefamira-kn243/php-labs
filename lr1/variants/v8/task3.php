<?php
$month = 2;

if ($month == 12 || $month == 1 || $month == 2) {
    $season = "зима";
} elseif ($month >= 3 && $month <= 5) {
    $season = "весна";
} elseif ($month >= 6 && $month <= 8) {
    $season = "літо";
} elseif ($month >= 9 && $month <= 11) {
    $season = "осінь";
} else {
    $season = "невірний номер місяця";
}

 
echo $season;
?>
