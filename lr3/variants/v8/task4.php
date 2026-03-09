<?php
/**
 * Завдання 4: Клонування об'єктів
 * Варіант 8: __clone() скидає дані до значень за замовчанням
 */
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Pilot.php';

// Оригінальний об'єкт (Григорій Клименко)
$pilot3 = new Pilot('Григорій Клименко', 'Windrose', 7800);

// Створюємо 4-й об'єкт через clone — автоматично спрацює __clone() в класі
$pilot4 = clone $pilot3;

ob_start();
?>

<div class="task-header">
    <h1>Завдання 4: Клонування</h1>
    <p>Магічний метод <code>__clone()</code> перевизначає дані при копіюванні</p>
</div>

<div class="code-block">
<span class="code-comment">// Метод __clone() у класі Pilot</span>
<span class="code-keyword">public function</span> <span class="code-method">__clone</span>(): <span class="code-class">void</span>
{
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">name</span> = <span class="code-string">'Пілот'</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">airline</span> = <span class="code-string">''</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">flightHours</span> = <span class="code-string">0</span>;
}

<span class="code-comment">// Виконання клонування</span>
<span class="code-variable">$pilot4</span> = <span class="code-keyword">clone</span> <span class="code-variable">$pilot3</span>;
</div>

<div class="section-divider">
    <span class="section-divider-text">Порівняння: Оригінал vs Клон</span>
</div>

<div class="comparison-wrapper">
    <div class="users-grid">
        <div class="user-card">
            <div class="user-card-header">
                <div class="user-card-avatar avatar-amber">Г</div>
                <div>
                    <div class="user-card-name"><?= htmlspecialchars($pilot3->name) ?></div>
                    <div class="user-card-label">$pilot3 <span class="user-card-badge badge-constructor">original</span></div>
                </div>
            </div>
            <div class="user-card-body">
                <div class="user-card-field">
                    <span class="user-card-field-label">Авіакомпанія</span>
                    <span class="user-card-field-value"><?= htmlspecialchars($pilot3->airline) ?></span>
                </div>
                <div class="user-card-field">
                    <span class="user-card-field-label">Наліт</span>
                    <span class="user-card-field-value"><?= $pilot3->flightHours ?> год.</span>
                </div>
            </div>
        </div>

        <div class="user-card">
            <div class="user-card-header">
                <div class="user-card-avatar avatar-rose">П</div>
                <div>
                    <div class="user-card-name"><?= htmlspecialchars($pilot4->name) ?></div>
                    <div class="user-card-label">$pilot4 <span class="user-card-badge badge-clone">clone</span></div>
                </div>
            </div>
            <div class="user-card-body">
                <div class="user-card-field">
                    <span class="user-card-field-label">Авіакомпанія</span>
                    <span class="user-card-field-value"><?= $pilot4->airline ?: '<em>не вказано</em>' ?></span>
                </div>
                <div class="user-card-field">
                    <span class="user-card-field-label">Наліт</span>
                    <span class="user-card-field-value"><?= $pilot4->flightHours ?> год.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-divider">
    <span class="section-divider-text">Результат getInfo()</span>
</div>

<div class="info-output">
    <div class="info-output-header">Перевірка значень через метод getInfo()</div>
    <div class="info-output-body">
        <div class="info-output-row">
            <span class="info-output-label">$pilot3</span>
            <span class="info-output-text"><?= htmlspecialchars($pilot3->getInfo()) ?></span>
        </div>
        <div class="info-output-row">
            <span class="info-output-label">$pilot4</span>
            <span class="info-output-text"><?= htmlspecialchars($pilot4->getInfo()) ?></span>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 4 (Варіант 8)', 'task4-body');