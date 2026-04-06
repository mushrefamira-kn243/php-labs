<?php

class SettingsController extends PageController
{
    private array $colors = [
        '#2C2C2C' => 'Рояльний чорний',
        '#D2B48C' => 'Скрипковий коричневий',
        '#FFFAF0' => 'Ноти на білому',
        '#B0C4DE' => 'Джазовий синій',
        '#FFE4B5' => 'Золотий саксофон'
    ];

    public function action_color(): void
    {
        if ($this->request->isPost()) {
            $this->saveColor();
            return;
        }

        $currentColor = $_SESSION['bg_color'] ?? '#FFFAF0';
        $message = $_SESSION['message'] ?? '';
        $messageType = $_SESSION['message_type'] ?? 'success';

        unset($_SESSION['message'], $_SESSION['message_type']);

        $this->render('settings/color', [
            'colors' => $this->colors,
            'currentColor' => $currentColor,
            'message' => $message,
            'messageType' => $messageType,
        ], 'Колір фону');
    }

    private function saveColor(): void
    {
        $color = $_POST['bg_color'] ?? '';
        $allowedColors = array_keys($this->colors);

        if (in_array($color, $allowedColors)) {
            $_SESSION['bg_color'] = $color;
            $_SESSION['message'] = 'Колір успішно змінено!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Неприпустимий колір!';
            $_SESSION['message_type'] = 'error';
        }

        $this->redirect('settings/color');
    }

    public function action_greeting(): void
    {
        if ($this->request->isPost()) {
            $this->saveGreeting();
            return;
        }

        $message = $_SESSION['message'] ?? '';
        $messageType = $_SESSION['message_type'] ?? 'success';
        unset($_SESSION['message'], $_SESSION['message_type']);

        $this->render('settings/greeting', [
            'currentName' => $_COOKIE['greeting_name'] ?? '',
            'currentGender' => $_COOKIE['greeting_gender'] ?? '',
            'message' => $message,
            'messageType' => $messageType,
        ], 'Привітання');
    }

    private function saveGreeting(): void
    {
        $name = trim($_POST['greeting_name'] ?? '');
        $gender = $_POST['greeting_gender'] ?? '';

        if ($name === '') {
            $_SESSION['message'] = "Введіть ім'я!";
            $_SESSION['message_type'] = 'error';
        } else {
            $expires = time() + 30 * 24 * 60 * 60;
            setcookie('greeting_name', $name, $expires, '/');
            setcookie('greeting_gender', $gender, $expires, '/');
            $_SESSION['message'] = 'Привітання збережено!';
            $_SESSION['message_type'] = 'success';
        }

        $this->redirect('settings/greeting');
    }

    public function color() {
        $colors = [
            'nocturne_blue' => '#191970',
            'classic_ivory' => '#FFFFF0',
            'royal_black' => '#1A1A2E',
            'gold_notes' => '#DAA520',
            'chord_lavender' => '#9370DB'
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['bg_color'] = $colors[$_POST['color']];
            header('Location: /settings/color');
        }
        $this->view->render('settings/color', ['colors' => $colors]);
    }
}
