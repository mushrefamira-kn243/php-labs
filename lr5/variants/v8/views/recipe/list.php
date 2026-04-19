<?php
$instruments = $instruments ?? [];
?>

<h1>Програма навчання</h1>
<p>Наш курс створено для тих, хто хоче розвивати музичний талант з нуля або підвищити свій рівень гри.</p>

<section class="info-block">
    <h2>Чотири роки музичної освіти</h2>

    <div class="card-grid">
        <div class="card">
            <h3 class="card__title">Перший рік</h3>
            <p class="card__text">
                Основи музичної грамоти, знайомство з ритмом і мелодією, перші вправи на інструменті.
                Особлива увага приділяється постановці руки, слуху та базовим нотним записам.
            </p>
        </div>
        <div class="card">
            <h3 class="card__title">Другий рік</h3>
            <p class="card__text">
                Розширення репертуару, робота над технікою, ансамблеві заняття,
                підбір індивідуальної програми за стилем учня.
            </p>
        </div>
        <div class="card">
            <h3 class="card__title">Третій рік</h3>
            <p class="card__text">
                Підготовка до виступів, сольні номери, розбір складніших творів та музичних форм.
                Початок підготовки до концертів та прослуховувань.
            </p>
        </div>
        <div class="card">
            <h3 class="card__title">Четвертий рік</h3>
            <p class="card__text">
                Глибоке вивчення жанрів, імпровізація та композиція, індивідуальний проект до кінця курсу.
                Учень опановує професійний підхід до музичної майстерності.
            </p>
        </div>
    </div>
</section>

<section class="info-block">
    <h2>Що входить до програми</h2>
    <ul class="program-list">
        <li>Індивідуальні уроки на фортепіано, гітарі, скрипці, барабанах, саксофоні та вокалі.</li>
        <li>Теорія музики, сольфеджіо та читання нот з листа.</li>
        <li>Робота в ансамблі, підготовка до виступів, сценічна майстерність.</li>
        <li>Сучасні методики та індивідуальний підхід до кожного учня.</li>
    </ul>
</section>

<section class="info-block">
    <h2>Наші викладачі</h2>

    <div class="card-grid">
        <div class="card">
            <h3 class="card__title">Ірина Лисенко</h3>
            <p class="card__text">Піаністка і педагог з 15-річним досвідом, лауреатка міжнародних конкурсів.</p>
        </div>
        <div class="card">
            <h3 class="card__title">Олександр Гнатюк</h3>
            <p class="card__text">Гітарист та аранжувальник, викладає електричну та класичну гітару.</p>
        </div>
        <div class="card">
            <h3 class="card__title">Марина Коваль</h3>
            <p class="card__text">Скрипалька, яка поєднує академічну школу з сучасними підходами до навчання.</p>
        </div>
    </div>
</section>

<?php if (!empty($instruments)): ?>
    <section class="info-block">
        <h2>Наш інструментальний парк</h2>
        <p>У школі є сучасні інструменти для занять: роялі, гітари, скрипки, барабани та інше обладнання.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Тип</th>
                    <th>Виробник</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instruments as $i): ?>
                    <tr>
                        <td><?= (int)$i['id'] ?></td>
                        <td><?= htmlspecialchars($i['name']) ?></td>
                        <td><?= htmlspecialchars($i['type']) ?></td>
                        <td><?= htmlspecialchars($i['brand']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
<?php endif; ?>
