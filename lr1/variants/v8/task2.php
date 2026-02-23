<?php
/**
 * Завдання 1: Форматований текст
 *
 * Вірш про котика з форматуванням: <b>, <i>, margin-left
 */
require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="poem">
    <?php
    echo "<p class='poem-indent-1'>Котик <b>спить</b> на теплій печі,</p>";
    echo "<p class='poem-indent-1'>За вікном мете <i>холодна</i> хуртовина,</p>";
    echo "<p class='poem-indent-1'>Бабуся вяже рукавиці,</p>";
    echo "<p class='poem-indent-1'>А в хаті пахне калина.</p>";
    ?>
</div>
<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');
