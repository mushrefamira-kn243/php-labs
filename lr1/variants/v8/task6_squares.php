<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.2</title>
    <style>
        .square-container {
            position: relative;
            width: 600px;
            height: 300px;
            background-color: black;
        }
        .square {
            position: absolute;
            background-color: red;
        }
    </style>
</head>
<body>
<?php
function generateRedSquares($n) {
    echo "<div class='square-container'>";
    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(20, 100);

        $top = mt_rand(0, 300 - $size);
        $left = mt_rand(0, 600 - $size);

        echo "<div class='square' style='width: {$size}px; height: {$size}px; top: {$top}px; left: {$left}px;'></div>";
    }
    echo "</div>";
}

generateRedSquares(9);
?>
</body>
</html>
