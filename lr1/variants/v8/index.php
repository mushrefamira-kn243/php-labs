<?php
require_once 'layout.php';

ob_start(); // починаємо буферизацію контенту
?>

<div style="margin-left: 30px; line-height: 1.6;">
    Котик <b>спить</b> на теплій печі,<br>
    За вікном мете <i>холодна</i> хуртовина,<br>
    Бабуся вяже рукавиці,<br>
    А в хаті пахне калина.
</div>

<?php
$content = ob_get_clean(); // отримуємо весь контент
renderLayout($content, "Завдання 1 — Форматований текст");
?>
