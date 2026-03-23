<?php

require_once __DIR__ . '/config/init.php';

$app = new Application();
$app->run();

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'settings/color':
        $controller = new SettingsController();
        $controller->action_color();
        break;

    case 'settings/saveColor':
        $controller = new SettingsController();
        $controller->action_saveColor();
        break;

    default:
        http_response_code(404);
        echo "404: Сторінку не знайдено";
        break;
}