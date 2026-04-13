<?php
$instruments = $instruments ?? [];
?>

<h1>Інструменти</h1>
<p>Колекція музичних інструментів. CRUD через PDO (prepared statements).</p>

<div class="form__actions" style="margin-bottom: 20px">
    <a href="index.php?route=recipe/create" class="btn">Додати інструмент</a>
</div>

<?php if (empty($instruments)): ?>
    <p class="text-muted">Інструментів ще немає.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Тип</th>
                <th>Виробник</th>
                <th>Ціна (грн)</th>
                <th>Стан</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instruments as $i): ?>
                <tr>
                    <td><?= (int)$i['id'] ?></td>
                    <td><?= htmlspecialchars($i['name']) ?></td>
                    <td><?= htmlspecialchars($i['type']) ?></td>
                    <td><?= htmlspecialchars($i['brand']) ?></td>
                    <td><?= number_format((float)$i['price'], 2, ',', ' ') ?> ₴</td>
                    <td><?= htmlspecialchars($i['condition']) ?></td>
                    <td class="table__actions">
                        <a href="index.php?route=recipe/edit&id=<?= (int)$i['id'] ?>" class="btn btn--small">Редагувати</a>
                        <form method="POST" action="index.php?route=recipe/delete" style="display:inline"
                              onsubmit="return confirm('Видалити інструмент?')">
                            <input type="hidden" name="id" value="<?= (int)$i['id'] ?>">
                            <button type="submit" class="btn btn--small btn--danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
