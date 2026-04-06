<h2>Інструменти</h2>

<a href="/instruments/add">Додати</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Назва</th>
        <th>Тип</th>
        <th>Бренд</th>
        <th>Ціна</th>
        <th>Стан</th>
        <th>Дії</th>
    </tr>

    <?php if (!empty($instruments)): ?>
        <?php foreach ($instruments as $i): ?>
            <tr>
                <td><?= htmlspecialchars($i['id'] ?? '') ?></td>
                <td><?= htmlspecialchars($i['name'] ?? '') ?></td>
                <td><?= htmlspecialchars($i['type'] ?? '') ?></td>
                <td><?= htmlspecialchars($i['brand'] ?? '') ?></td>
                <td><?= htmlspecialchars($i['price'] ?? '') ?></td>
                <td><?= htmlspecialchars($i['condition'] ?? '') ?></td>
                <td>
                    <a href="/instruments/edit/<?= htmlspecialchars($i['id'] ?? '') ?>">Редагувати</a> |
                    <a href="/instruments/delete/<?= htmlspecialchars($i['id'] ?? '') ?>" onclick="return confirm('Ви впевнені, що хочете видалити?')">Видалити</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Немає інструментів</td>
        </tr>
    <?php endif; ?>
</table>