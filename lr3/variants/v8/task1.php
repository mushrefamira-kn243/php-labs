<?php
/**
 * Завдання 1: Створення класів та об'єктів
 * Варіант 8: Клас Pilot
 */
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Pilot.php';

// Створюємо 3 об'єкти згідно з вашими даними для 8 варіанту
$pilot1 = new Pilot();
$pilot1->name = 'Павло Марченко';
$pilot1->airline = 'МАУ';
$pilot1->flightHours = 5200;

$pilot2 = new Pilot();
$pilot2->name = 'Вікторія Тимошенко';
$pilot2->airline = 'SkyUp';
$pilot2->flightHours = 3100;

$pilot3 = new Pilot();
$pilot3->name = 'Григорій Клименко';
$pilot3->airline = 'Windrose';
$pilot3->flightHours = 7800;

// Масив для циклу виводу в картки
$pilots = [
    ['obj' => $pilot1, 'avatar' => 'avatar-indigo', 'initial' => 'П'],
    ['obj' => $pilot2, 'avatar' => 'avatar-green', 'initial' => 'В'],
    ['obj' => $pilot3, 'avatar' => 'avatar-amber', 'initial' => 'Г'],
];

ob_start();
?>

<div class="task-header">
    <h1>Завдання 1: Створення об'єктів</h1>
    <p>Клас <code>Pilot</code> (Варіант 8)</p>
</div>

<div class="code-block">
<span class="code-comment">// Ініціалізація об'єктів Pilot</span>
<span class="code-variable">$pilot1</span> = <span class="code-keyword">new</span> <span class="code-class">Pilot</span>();
<span class="code-variable">$pilot1</span><span class="code-arrow">-></span><span class="code-method">name</span> = <span class="code-string">'<?= htmlspecialchars($pilot1->name) ?>'</span>;
<span class="code-variable">$pilot1</span><span class="code-arrow">-></span><span class="code-method">airline</span> = <span class="code-string">'<?= htmlspecialchars($pilot1->airline) ?>'</span>;
<span class="code-variable">$pilot1</span><span class="code-arrow">-></span><span class="code-method">flightHours</span> = <span class="code-string"><?= $pilot1->flightHours ?></span>;
</div>

<div class="section-divider">
    <span class="section-divider-text">Список пілотів</span>
</div>

<div class="users-grid">
    <?php foreach ($pilots as $i => $data): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $data['avatar'] ?>"><?= $data['initial'] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($data['obj']->name) ?></div>
                <div class="user-card-label">Об'єкт Pilot #<?= $i + 1 ?></div>
            </div>
        </div>
        <div class="user-card-body">
            <div class="user-card-field">
                <span class="user-card-field-label">Авіакомпанія</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->airline) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">Досвід (наліт)</span>
                <span class="user-card-field-value"><?= $data['obj']->flightHours ?> год.</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
// Викликаємо функцію рендеру, вказуючи 8 варіант у заголовку
renderVariantLayout($content, 'Завдання 1 (Варіант 8)', 'task1-body');