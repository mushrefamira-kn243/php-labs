<?php

class SettingsController extends PageController
{
    private array $availableColors = [
        '#191970' => 'Ноктюрн синій',
        '#FFFFF0' => 'Класична слонова кістка',
        '#1A1A2E' => 'Рояльний чорний',
        '#DAA520' => 'Золото нот',
        '#9370DB' => 'Акордова бузкова',
    ];

    public function action_color(): void
    {
        $message = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bg_color'])) {
            $color = $_POST['bg_color'];

            if (array_key_exists($color, $this->availableColors)) {
                $_SESSION['bg_color'] = $color;
                $message = 'Колір фону збережено!';
            } else {
                $error = 'Невідомий колір.';
            }
        }

        $this->render('settings/color', [
            'colors' => $this->availableColors,
            'currentColor' => $_SESSION['bg_color'] ?? '#FFFFF0',
            'message' => $message,
            'error' => $error,
        ], 'Колір фону');
    }

    public function action_greeting(): void
    {
        $message = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['greeting_name'] ?? '');
            $gender = $_POST['greeting_gender'] ?? '';

            if ($name === '') {
                $error = "Ім'я не може бути порожнім.";
            } elseif (!in_array($gender, ['male', 'female'], true)) {
                $error = 'Оберіть стать.';
            } else {
                setcookie('greeting_name', $name, time() + 30 * 24 * 3600, '/');
                setcookie('greeting_gender', $gender, time() + 30 * 24 * 3600, '/');

                $_COOKIE['greeting_name'] = $name;
                $_COOKIE['greeting_gender'] = $gender;

                $message = 'Привітання збережено в cookie!';
            }
        }

        $this->render('settings/greeting', [
            'message' => $message,
            'error' => $error,
            'currentName' => $_COOKIE['greeting_name'] ?? '',
            'currentGender' => $_COOKIE['greeting_gender'] ?? '',
        ], 'Привітання (Cookie)');
    }
}