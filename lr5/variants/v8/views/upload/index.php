<h2>Гостьова книга</h2>

<form method="post" action="/guestbook/add">
    Ім'я: <input type="text" name="name" required><br>
    Коментар: <textarea name="comment" required></textarea><br>
    <button type="submit">Додати</button>
</form>

<table border="1">
    <tr>
        <th>Дата</th>
        <th>Ім'я</th>
        <th>Коментар</th>
    </tr>

    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['date'] ?? '') ?></td>
                <td><?= htmlspecialchars($c['name'] ?? '') ?></td>
                <td><?= htmlspecialchars($c['comment'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Немає коментарів</td>
        </tr>
    <?php endif; ?>
</table>