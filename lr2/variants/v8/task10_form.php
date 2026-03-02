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
    setcookie('lang', $lang, time() + 6 * 30 * 24 * 3600, '/'); 
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
    $hobbies = $_POST['hobbies'] ?? []; // Це масив
    $about = trim($_POST['about'] ?? '');

    // Валідація
    if (empty($login)) $errors[] = "Логін не може бути порожнім";
    if (mb_strlen($pass1) < 4) $errors[] = "Пароль має бути не менше 4 символів";
    if ($pass1 !== $pass2) $errors[] = "Паролі не збігаються";
    if (empty($gender)) $errors[] = "Оберіть стать";
    if (empty($city)) $errors[] = "Оберіть місто";

    // Завантаження фото
    $photoPath = $sessionData['photo'] ?? '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $photoName = uniqid('ava_') . '.' . $ext;
            $uploadDir = __DIR__ . '/uploads';
            
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . '/' . $photoName)) {
                $photoPath = 'uploads/' . $photoName;
            }
        } else {
            $errors[] = "Недопустимий формат фото (дозволено: JPG, PNG, GIF, WEBP)";
        }
    }

    // Тимчасово зберігаємо введені дані в масив для сесії
    $regData = [
        'login' => $login,
        'gender' => $gender,
        'city' => $city,
        'hobbies' => $hobbies,
        'about' => $about,
        'photo' => $photoPath
    ];

    $_SESSION['user_reg'] = $regData;

    if (empty($errors)) {
        header("Location: task10_result.php");
        exit;
    }
}

// Пріоритет автозаповнення: 1. Дані з форми після помилки, 2. Дані з сесії, 3. Значення за замовчуванням
$fill = [
    'login'   => $_POST['login'] ?? $sessionData['login'] ?? 'dnipro_svitlana',
    'gender'  => $_POST['gender'] ?? $sessionData['gender'] ?? '',
    'city'    => $_POST['city'] ?? $sessionData['city'] ?? '',
    'hobbies' => $_POST['hobbies'] ?? $sessionData['hobbies'] ?? [],
    'about'   => $_POST['about'] ?? $sessionData['about'] ?? '',
];

ob_start();
?>
<style>
    .lang-box { margin-bottom: 20px; text-align: right; }
    .lang-link { text-decoration: none; font-size: 1.5rem; margin-left: 10px; padding: 5px; border-radius: 5px; border: 1px solid transparent; }
    .lang-link.active { background: #e8f4fd; border-color: #3498db; }
    .error-box { background: #fff1f0; border: 1px solid #ffa39e; padding: 15px; color: #cf1322; margin-bottom: 20px; border-radius: 4px; }
    .form-group { margin-bottom: 15px; }
    label { display: block; font-weight: bold; margin-bottom: 5px; }
    input[type="text"], input[type="password"], select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 1rem; }
    .radio-group label, .checkbox-group label { display: inline-block; font-weight: normal; margin-right: 15px; cursor: pointer; }
    .btn-submit { width: 100%; background: #27ae60; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 1.1rem; transition: background 0.3s; }
    .btn-submit:hover { background: #219150; }
</style>

<div class="demo-card">
    <div class="lang-box">
        <?php 
// Змінимо масив мов, щоб розділити іконку та назву
$languages = [
    'uk' => ['icon' => '🇺🇦', 'name' => 'Українська'],
    'en' => ['icon' => '🇺🇸', 'name' => 'English'],
    'de' => ['icon' => '🇩🇪', 'name' => 'Deutsch'],
];
?>

<?php foreach ($languages as $code => $info): ?>
    <a href="?lang=<?= $code ?>" class="lang-link <?= $lang === $code ? 'active' : '' ?>" title="<?= $info['name'] ?>">
        <?= $info['icon'] ?>
    </a>
<?php endforeach; ?>
    </div>

    <h2>Реєстрація користувача</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <h4 style="margin: 0 0 10px 0;">Виправте наступні помилки:</h4>
            <?php foreach ($errors as $err) echo "<div>• " . htmlspecialchars($err) . "</div>"; ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="login">Логін:</label>
            <input type="text" id="login" name="login" value="<?= htmlspecialchars($fill['login']) ?>">
        </div>

        <div style="display: flex; gap: 15px;" class="form-group">
            <div style="flex: 1;">
                <label for="pass1">Пароль:</label>
                <input type="password" id="pass1" name="pass1" placeholder="мін. 4 символи">
            </div>
            <div style="flex: 1;">
                <label for="pass2">Повтор пароля:</label>
                <input type="password" id="pass2" name="pass2">
            </div>
        </div>

        <div class="form-group">
            <label>Стать:</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="male" <?= $fill['gender'] == 'male' ? 'checked' : '' ?>> Чоловік</label>
                <label><input type="radio" name="gender" value="female" <?= $fill['gender'] == 'female' ? 'checked' : '' ?>> Жінка</label>
            </div>
        </div>

        <div class="form-group">
            <label for="city">Місто:</label>
            <select id="city" name="city">
                <option value="">-- Оберіть місто --</option>
                <?php foreach ($cities as $c): ?>
                    <option value="<?= htmlspecialchars($c) ?>" <?= $fill['city'] == $c ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Хобі:</label>
            <div class="checkbox-group">
                <?php foreach ($hobbiesList as $k => $v): ?>
                    <label>
                        <input type="checkbox" name="hobbies[]" value="<?= $k ?>" <?= in_array($k, $fill['hobbies']) ? 'checked' : '' ?>> <?= $v ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="about">Про себе:</label>
            <textarea id="about" name="about" rows="3"><?= htmlspecialchars($fill['about']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="photo">Фото профілю (JPG, PNG, WEBP):</label>
            <input type="file" id="photo" name="photo" accept="image/*">
            <?php if (!empty($sessionData['photo'])): ?>
                <p style="font-size: 0.8rem; color: #666;">Фото вже завантажено. Оберіть нове, якщо хочете його змінити.</p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-submit">Зареєструватися</button>
    </form>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 10 — Форма');