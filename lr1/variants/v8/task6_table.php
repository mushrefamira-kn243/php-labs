<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.1</title>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        td {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<?php
function generateColorTable($rows, $cols) {
    echo "<table border='1'>";
    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            echo "<td style='background-color: $color;'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

generateColorTable(4, 8);
?>
</body>
</html>
