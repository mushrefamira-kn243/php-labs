<h2>Редагувати інструмент</h2>

<form method="post">
    Назва: <input type="text" name="name" value="<?= htmlspecialchars($instrument['name'] ?? '') ?>" required><br>
    Тип: <input type="text" name="type" value="<?= htmlspecialchars($instrument['type'] ?? '') ?>" required><br>
    Бренд: <input type="text" name="brand" value="<?= htmlspecialchars($instrument['brand'] ?? '') ?>" required><br>
    Ціна: <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($instrument['price'] ?? '') ?>" required><br>
    Стан: <input type="text" name="condition" value="<?= htmlspecialchars($instrument['condition'] ?? '') ?>" required><br>
    <button type="submit">Зберегти</button>
</form>