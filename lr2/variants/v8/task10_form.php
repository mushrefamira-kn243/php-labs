<?php
session_start();
require_once __DIR__ . '/layout.php';

// --- Робота з Cookie (Мова) ---
$languages = [
    'uk' => '🇺🇦 Українська',
    'en' => '🇺🇸 English',
    'de' => '🇩🇪 Deutsch',
];

if (isset($_GET['lang']) && isset($languages[$_GET['lang']])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + 6 * 30 * 24 * 3600, '/'); // 6 місяців
} else {
    $lang = $_COOKIE['lang'] ?? 'uk';
}

// --- Дані ---
$cities = ['Київ', 'Львів', 'Одеса', 'Харків', 'Дніпро', 'Запоріжжя', 'Вінниця', 'Полтава', 'Чернігів', 'Тернопіль'];
$hobbiesList = ['sport' => 'Спорт', 'music' => 'Музика', 'travel' => 'Подорожі', 'code' => 'Програмування'];

$errors = [];
$sessionData = $_SESSION['user_reg'] ?? [];

// --- Обробка POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass1 = $_POST['pass1'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $hobbies = $_POST['hobbies'] ?? [];
    $about = trim($_POST['about'] ?? '');

    // Валідація
    if (empty($login)) $errors[] = "Логін не може бути порожнім";
    if (strlen($pass1) < 4) $errors[] = "Пароль має бути ≥ 4 символів";
    if ($pass1 !== $pass2) $errors[] = "Паролі не збігаються";
    if (empty($gender)) $errors[] = "Оберіть стать";
    if (empty($city)) $errors[] = "Оберіть місто";

    // Завантаження фото
    $photoName = $sessionData['photo'] ?? '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = 'uploads/' . uniqid('ava_') . '.' . $ext;
        if (!is_dir('uploads')) mkdir('uploads', 0755);
        move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/' . $photoName);
    }

    // Збереження в сесію
    $_SESSION['user_reg'] = [
        'login' => $login,
        'gender' => $gender,
        'city' => $city,
        'hobbies' => $hobbies,
        'about' => $about,
        'photo' => $photoName
    ];

    if (empty($errors)) {
        header("Location: task10_result.php");
        exit;
    }
}

// Автозаповнення
$fill = $_SESSION['user_reg'] ?? ['login' => 'dnipro_svitlana', 'gender' => '', 'city' => '', 'hobbies' => [], 'about' => ''];

ob_start();
?>
<style>
    .lang-box { margin-bottom: 20px; text-align: right; }
    .lang-link { text-decoration: none; font-size: 1.5rem; margin-left: 10px; padding: 5px; border-radius: 5px; }
    .lang-link.active { background: #e8f4fd; border: 1px solid #3498db; }
    .error-box { background: #fff1f0; border: 1px solid #ffa39e; padding: 10px; color: #cf1322; margin-bottom: 20px; border-radius: 4px; }
    .form-group { margin-bottom: 15px; }
    label { display: block; font-weight: bold; margin-bottom: 5px; }
    input[type="text"], input[type="password"], select, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
</style>

<div class="demo-card">
    <div class="lang-box">
        <?php foreach ($languages as $code => $label): ?>
            <a href="?lang=<?= $code ?>" class="lang-link <?= $lang === $code ? 'active' : '' ?>" title="<?= $label ?>"><?= mb_substr($label, 0, 2) ?></a>
        <?php endforeach; ?>
    </div>

    <h2>Реєстрація користувача</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <?php foreach ($errors as $err) echo "<div>• $err</div>"; ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Логін:</label>
            <input type="text" name="login" value="<?= htmlspecialchars($fill['login']) ?>">
        </div>

        <div style="display: flex; gap: 10px;" class="form-group">
            <div style="flex: 1;">
                <label>Пароль:</label>
                <input type="password" name="pass1">
            </div>
            <div style="flex: 1;">
                <label>Повтор:</label>
                <input type="password" name="pass2">
            </div>
        </div>

        <div class="form-group">
            <label>Стать:</label>
            <input type="radio" name="gender" value="male" <?= $fill['gender'] == 'male' ? 'checked' : '' ?>> Чоловік
            <input type="radio" name="gender" value="female" <?= $fill['gender'] == 'female' ? 'checked' : '' ?>> Жінка
        </div>

        <div class="form-group">
            <label>Місто:</label>
            <select name="city">
                <option value="">-- Оберіть --</option>
                <?php foreach ($cities as $c): ?>
                    <option value="<?= $c ?>" <?= $fill['city'] == $c ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Хобі:</label>
            <?php foreach ($hobbiesList as $k => $v): ?>
                <label style="display: inline-block; font-weight: normal; margin-right: 10px;">
                    <input type="checkbox" name="hobbies[]" value="<?= $k ?>" <?= in_array($k, $fill['hobbies']) ? 'checked' : '' ?>> <?= $v ?>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form-group">
            <label>Про себе:</label>
            <textarea name="about" rows="3"><?= htmlspecialchars($fill['about']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Фото профілю:</label>
            <input type="file" name="photo">
        </div>

        <button type="submit" class="btn-submit" style="width: 100%; background: #27ae60; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer;">Зареєструватися</button>
    </form>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 10 — Форма');