<?php
/**
 * Завдання 1: Форматований текст (варіант 8)
 */
require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="poem">
    <?php
    echo "<p style='margin-left: 20px;'>Котик <b>спить</b> на теплій печі,</p>";
    echo "<p style='margin-left: 20px;'>За вікном мете <i>холодна</i> хуртовина,</p>";
    echo "<p style='margin-left: 20px;'>Бабуся вяже рукавиці,</p>";
    echo "<p style='margin-left: 20px;'>А в хаті пахне калина.</p>";
    ?>
</div>
<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');
?>
