<?php

require_once 'classes/Controller.php';

class GuestbookController extends Controller {

    public function index() {
        $comments = [];

        if (file_exists('data/comments.txt')) {
            $lines = file('data/comments.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                $parts = explode('|', $line);

                // Проверка, чтобы не было ошибок
                if (count($parts) === 3) {
                    list($date, $name, $comment) = $parts;

                    $comments[] = [
                        'date' => $date,
                        'name' => $name,
                        'comment' => $comment
                    ];
                }
            }
        }

        $this->view->render('guestbook/index', ['comments' => $comments]);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $comment = trim($_POST['comment'] ?? '');

            if (!empty($name) && !empty($comment)) {
                $date = date('Y-m-d H:i:s');

                // Убираем символы-разделители, чтобы не ломать файл
                $name = str_replace('|', '/', $name);
                $comment = str_replace('|', '/', $comment);

                $line = $date . '|' . $name . '|' . $comment . PHP_EOL;

                file_put_contents('data/comments.txt', $line, FILE_APPEND | LOCK_EX);
            }
        }

        header('Location: /guestbook');
        exit;
    }
}