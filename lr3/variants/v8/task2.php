<?php
/**
 * Завдання 2: Метод getInfo()
 * Варіант 8: Метод класу Pilot, що виводить інформацію
 */
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Pilot.php';

// Створюємо 3 об'єкти (ваші дані)
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

$pilots = [$pilot1, $pilot2, $pilot3];
$labels = ['$pilot1', '$pilot2', '$pilot3'];

ob_start();
?>

<div class="task-header">
    <h1>Метод getInfo()</h1>
    <p>Виводить значення властивостей об'єкта класу Pilot</p>
</div>

<div class="code-block">
<span class="code-comment">// Метод getInfo() повертає рядок з інформацією</span>
<span class="code-keyword">public function</span> <span class="code-method">getInfo</span>(): <span class="code-class">string</span>
{
    <span class="code-keyword">return</span> <span class="code-string">"Пілот: {$this->name}, Авіакомпанія: {$this->airline}, Наліт: {$this->flightHours} год"</span>;
}

<span class="code-comment">// Виклик методу для кожного пілота</span>
<span class="code-variable">$pilot1</span><span class="code-arrow">-></span><span class="code-method">getInfo</span>();
</div>

<div class="section-divider">
    <span class="section-divider-text">Результат виклику методу</span>
</div>

<div class="info-output">
    <div class="info-output-header">getInfo() — вивід для кожного пілота</div>
    <div class="info-output-body">
        <?php foreach ($pilots as $i => $pilot): ?>
        <div class="info-output-row">
            <span class="info-output-label"><?= $labels[$i] ?></span>
            <span class="info-output-text"><?= htmlspecialchars($pilot->getInfo()) ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="section-divider">
    <span class="section-divider-text">Картки екіпажу</span>
</div>

<div class="users-grid">
    <?php
    $avatars = ['avatar-indigo', 'avatar-green', 'avatar-amber'];
    $initials = ['П', 'В', 'Г'];
    foreach ($pilots as $i => $pilot):
    ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $avatars[$i] ?>"><?= $initials[$i] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($pilot->name) ?></div>
                <div class="user-card-label"><?= $labels[$i] ?>->getInfo()</div>
            </div>
        </div>
        <div class="user-card-body">
            <div class="user-card-field">
                <span class="user-card-field-label">Пілот</span>
                <span class="user-card-field-value"><?= htmlspecialchars($pilot->name) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">Компанія</span>
                <span class="user-card-field-value"><?= htmlspecialchars($pilot->airline) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">Досвід</span>
                <span class="user-card-field-value"><?= $pilot->flightHours ?> год.</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 2 (Варіант 8)', 'task2-body');