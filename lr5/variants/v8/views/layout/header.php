<?php
$bgColor = $_SESSION['bg_color'] ?? '#FFFFF0';
$greetingName = is_string($_COOKIE['greeting_name'] ?? '') ? ($_COOKIE['greeting_name'] ?? '') : '';
$greetingGender = is_string($_COOKIE['greeting_gender'] ?? '') ? ($_COOKIE['greeting_gender'] ?? '') : '';

$themes = [
    '#191970' => [
        '--bg' => '#191970',
        '--surface' => '#ffffff',
        '--surface-soft' => '#eff6ff',
        '--text' => '#0f172a',
        '--muted' => '#475569',
        '--accent' => '#7c3aed',
        '--accent-soft' => '#ede9fe',
    ],
    '#FFFFF0' => [
        '--bg' => '#fffff0',
        '--surface' => '#ffffff',
        '--surface-soft' => '#f8fafc',
        '--text' => '#111827',
        '--muted' => '#475569',
        '--accent' => '#2563eb',
        '--accent-soft' => '#dbeafe',
    ],
    '#1A1A2E' => [
        '--bg' => '#1a1a2e',
        '--surface' => '#ffffff',
        '--surface-soft' => '#eff6ff',
        '--text' => '#111827',
        '--muted' => '#475569',
        '--accent' => '#7c3aed',
        '--accent-soft' => '#ede9fe',
    ],
    '#DAA520' => [
        '--bg' => '#daa520',
        '--surface' => '#ffffff',
        '--surface-soft' => '#fef7e0',
        '--text' => '#111827',
        '--muted' => '#475569',
        '--accent' => '#1d4ed8',
        '--accent-soft' => '#dbeafe',
    ],
    '#9370DB' => [
        '--bg' => '#9370db',
        '--surface' => '#ffffff',
        '--surface-soft' => '#f3e8ff',
        '--text' => '#111827',
        '--muted' => '#475569',
        '--accent' => '#4f46e5',
        '--accent-soft' => '#ede9fe',
    ],
];

$theme = $themes[$bgColor] ?? $themes['#FFFFF0'];
$themeStyle = '';
foreach ($theme as $name => $value) {
    $themeStyle .= "{$name}:{$value};";
}

$greetingText = '';
if ($greetingName !== '') {
    $title = $greetingGender === 'female' ? 'пані' : 'пане';
    $greetingText = "Вітаємо Вас, {$title} " . htmlspecialchars($greetingName) . "!";
}

$isLoggedIn = isset($_SESSION['user_id']);
$userLogin = $_SESSION['user_login'] ?? '';

$currentRoute = $_GET['route'] ?? 'index/main';

$navItems = [
    'index/main' => 'Головна',
    'guestbook/index' => 'Гостьова книга',
    'upload/index' => 'Завантаження',
    'regform/form' => 'Запис',
    'recipe/list' => 'Програма',
    'settings/index' => 'Налаштування',
];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(($pageTitle ?? '') !== '' ? $pageTitle : 'Музична школа') ?> — Музична школа</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="<?= htmlspecialchars($themeStyle) ?>">
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="index.php" class="header__logo">Музична школа</a>
                <?php if ($greetingText !== ''): ?>
                    <span class="header__greeting"><?= $greetingText ?></span>
                <?php endif; ?>
                <div class="header__auth">
                    <?php if ($isLoggedIn): ?>
                        <a href="index.php?route=auth/profile" class="header__auth-link"><?= htmlspecialchars($userLogin) ?></a>
                        <a href="index.php?route=auth/logout" class="header__auth-link header__auth-link--logout">Вийти</a>
                    <?php else: ?>
                        <a href="index.php?route=auth/login" class="header__auth-link">Увійти</a>
                        <a href="index.php?route=auth/register" class="header__auth-link">Реєстрація</a>
                    <?php endif; ?>
                </div>
            </div>
            <nav class="nav">
                <ul class="nav__list">
                    <?php foreach ($navItems as $route => $label): ?>
                        <li class="nav__item">
                            <a href="index.php?route=<?= $route ?>"
                               class="nav__link<?= $currentRoute === $route ? ' nav__link--active' : '' ?>">
                                <?= htmlspecialchars($label) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main">
        <div class="container">
