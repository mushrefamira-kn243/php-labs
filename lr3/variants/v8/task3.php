<?php
/**
 * Завдання 3: Конструктор
 * Варіант 8: Ініціалізація через __construct
 */
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Pilot.php';

// Створюємо об'єкти за один крок через конструктор
$pilot1 = new Pilot('Павло Марченко', 'МАУ', 5200);
$pilot2 = new Pilot('Вікторія Тимошенко', 'SkyUp', 3100);
$pilot3 = new Pilot('Григорій Клименко', 'Windrose', 7800);

$pilots = [
    ['obj' => $pilot1, 'avatar' => 'avatar-indigo', 'initial' => 'П', 'var' => '$pilot1'],
    ['obj' => $pilot2, 'avatar' => 'avatar-green', 'initial' => 'В', 'var' => '$pilot2'],
    ['obj' => $pilot3, 'avatar' => 'avatar-amber', 'initial' => 'Г', 'var' => '$pilot3'],
];

ob_start();
?>

<div class="task-header">
    <h1>Завдання 3: Конструктор</h1>
    <p>Використання методу <code>__construct</code> для автоматичного заповнення властивостей</p>
</div>

<div class="code-block">
<span class="code-comment">// Опис конструктора в класі Pilot</span>
<span class="code-keyword">public function</span> <span class="code-method">__construct</span>(<span class="code-class">string</span> <span class="code-variable">$name</span>, <span class="code-class">string</span> <span class="code-variable">$airline</span>, <span class="code-class">int</span> <span class="code-variable">$flightHours</span>)
{
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">name</span> = <span class="code-variable">$name</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">airline</span> = <span class="code-variable">$airline</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">flightHours</span> = <span class="code-variable">$flightHours</span>;
}

<span class="code-comment">// Створення об'єктів (новий синтаксис)</span>
<span class="code-variable">$pilot1</span> = <span class="code-keyword">new</span> <span class="code-class">Pilot</span>(<span class="code-string">'Павло Марченко'</span>, <span class="code-string">'МАУ'</span>, <span class="code-string">5200</span>);
</div>

<div class="section-divider">
    <span class="section-divider-text">Об'єкти ініціалізовані через конструктор</span>
</div>

<div class="users-grid">
    <?php foreach ($pilots as $data): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $data['avatar'] ?>"><?= $data['initial'] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($data['obj']->name) ?></div>
                <div class="user-card-label"><?= $data['var'] ?> <span class="user-card-badge badge-constructor">constructor</span></div>
            </div>
        </div>
        <div class="user-card-body">
            <div class="user-card-field">
                <span class="user-card-field-label">Пілот</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->name) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">Компанія</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->airline) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">Наліт</span>
                <span class="user-card-field-value"><?= $data['obj']->flightHours ?> год.</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="section-divider">
    <span class="section-divider-text">Перевірка через getInfo()</span>
</div>

<div class="info-output">
    <div class="info-output-header">Виклик getInfo() для підтвердження успішної ініціалізації</div>
    <div class="info-output-body">
        <?php foreach ($pilots as $data): ?>
        <div class="info-output-row">
            <span class="info-output-label"><?= $data['var'] ?></span>
            <span class="info-output-text"><?= htmlspecialchars($data['obj']->getInfo()) ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 3 (Варіант 8)', 'task3-body');