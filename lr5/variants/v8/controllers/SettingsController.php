<?php
session_start(); // старт сесії

class SettingsController
{
    // Форма вибору кольору
    public function action_color(): void
    {
        $colors = [
            '#2C2C2C' => 'Рояльний чорний',
            '#D2B48C' => 'Скрипковий коричневий',
            '#FFFAF0' => 'Ноти на білому',
            '#B0C4DE' => 'Джазовий синій',
            '#FFE4B5' => 'Золотий саксофон'
        ];

        $currentColor = $_SESSION['bg_color'] ?? '#FFFAF0';
        $message = $_SESSION['message'] ?? '';
        $messageType = $_SESSION['message_type'] ?? 'success';

        // Очищуємо повідомлення після показу
        unset($_SESSION['message'], $_SESSION['message_type']);

        include __DIR__ . '/../views/settings/color.php';
    }

    // Збереження вибраного кольору
    public function action_saveColor(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bg_color'])) {
            $allowedColors = ['#2C2C2C', '#D2B48C', '#FFFAF0', '#B0C4DE', '#FFE4B5'];
            $color = $_POST['bg_color'];

            if (in_array($color, $allowedColors)) {
                $_SESSION['bg_color'] = $color;
                $_SESSION['message'] = "Колір успішно змінено!";
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = "Неприпустимий колір!";
                $_SESSION['message_type'] = 'error';
            }
        } else {
            $_SESSION['message'] = "Не обрано колір!";
            $_SESSION['message_type'] = 'error';
        }

        // Редірект назад на форму
        header('Location: index.php?route=settings/color');
        exit;
    }
}