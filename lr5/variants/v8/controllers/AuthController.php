<?php

class AuthController extends PageController
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    public function action_register(): void
    {
        if ($this->isLoggedIn()) {
            header('Location: index.php?route=auth/profile');
            exit;
        }

        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $_POST;
            $errors = $this->validateRegister($old);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'INSERT INTO users (login, password, email, first_name, last_name, phone, city, gender, about)
                     VALUES (:login, :password, :email, :first_name, :last_name, :phone, :city, :gender, :about)'
                );
                $stmt->execute([
                    ':login' => trim($old['login']),
                    ':password' => password_hash($old['password'], PASSWORD_DEFAULT),
                    ':email' => trim($old['email']),
                    ':first_name' => trim($old['first_name']),
                    ':last_name' => trim($old['last_name']),
                    ':phone' => trim($old['phone'] ?? ''),
                    ':city' => trim($old['city'] ?? ''),
                    ':gender' => $old['gender'] ?? '',
                    ':about' => trim($old['about'] ?? ''),
                ]);

                session_regenerate_id(true);
                $_SESSION['user_id'] = $this->db->lastInsertId();
                $_SESSION['user_login'] = trim($old['login']);
                header('Location: index.php?route=auth/profile');
                exit;
            }
        }

        $this->render('auth/register', [
            'errors' => $errors,
            'old' => $old,
        ], 'Реєстрація');
    }

    public function action_login(): void
    {
        if ($this->isLoggedIn()) {
            header('Location: index.php?route=auth/profile');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($login === '' || $password === '') {
                $error = 'Введіть логін та пароль.';
            } else {
                $stmt = $this->db->prepare('SELECT * FROM users WHERE login = :login');
                $stmt->execute([':login' => $login]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_login'] = $user['login'];
                    header('Location: index.php?route=auth/profile');
                    exit;
                }

                $error = 'Невірний логін або пароль.';
            }
        }

        $this->render('auth/login', [
            'error' => $error,
        ], 'Вхід');
    }

    public function action_profile(): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!$user) {
            $this->action_logout();
            return;
        }

        $this->render('auth/profile', [
            'user' => $user,
        ], 'Профіль');
    }

    public function action_edit(): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!$user) {
            $this->action_logout();
            return;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $errors = $this->validateEdit($data, $user);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'UPDATE users SET email = :email, first_name = :first_name, last_name = :last_name,
                     phone = :phone, city = :city, gender = :gender, about = :about WHERE id = :id'
                );
                $stmt->execute([
                    ':email' => trim($data['email']),
                    ':first_name' => trim($data['first_name']),
                    ':last_name' => trim($data['last_name']),
                    ':phone' => trim($data['phone'] ?? ''),
                    ':city' => trim($data['city'] ?? ''),
                    ':gender' => $data['gender'] ?? '',
                    ':about' => trim($data['about'] ?? ''),
                    ':id' => $user['id'],
                ]);

                $_SESSION['flash_success'] = 'Профіль оновлено!';
                header('Location: index.php?route=auth/profile');
                exit;
            }

            $user = array_merge($user, $data);
        }

        $this->render('auth/edit', [
            'user' => $user,
            'errors' => $errors,
        ], 'Редагувати профіль');
    }

    public function action_logout(): void
    {
        unset($_SESSION['user_id'], $_SESSION['user_login']);
        session_regenerate_id(true);
        header('Location: index.php?route=index/main');
        exit;
    }

    public function action_delete(): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute([':id' => $_SESSION['user_id']]);

            unset($_SESSION['user_id'], $_SESSION['user_login']);
            session_regenerate_id(true);

            $_SESSION['flash_success'] = 'Ваш акаунт видалено.';
            header('Location: index.php?route=index/main');
            exit;
        }

        $this->render('auth/delete', [], 'Видалення акаунту');
    }

    private function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    private function validateRegister(array $data): array
    {
        $errors = [];

        $login = trim($data['login'] ?? '');
        if ($login === '') {
            $errors['login'] = 'Логін є обов\'язковим.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $login)) {
            $errors['login'] = 'Логін: 3-50 символів (латинські літери, цифри, _).';
        } else {
            $stmt = $this->db->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
            $stmt->execute([':login' => $login]);
            if ($stmt->fetchColumn() > 0) {
                $errors['login'] = 'Цей логін вже зайнятий.';
            }
        }

        $password = $data['password'] ?? '';
        if (strlen($password) < 5) {
            $errors['password'] = 'Пароль має бути мінімум 5 символів.';
        } elseif (!preg_match('/\d/', $password)) {
            $errors['password'] = 'Пароль має містити хоча б одну цифру.';
        }

        $email = trim($data['email'] ?? '');
        if ($email === '') {
            $errors['email'] = 'E-mail є обов\'язковим.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Невірний формат e-mail.';
        }

        if (trim($data['first_name'] ?? '') === '') {
            $errors['first_name'] = 'Ім\'я є обов\'язковим.';
        }

        if (trim($data['last_name'] ?? '') === '') {
            $errors['last_name'] = 'Прізвище є обов\'язковим.';
        }

        return $errors;
    }

    private function validateEdit(array $data, array $user): array
    {
        $errors = [];

        $email = trim($data['email'] ?? '');
        if ($email === '') {
            $errors['email'] = 'E-mail є обов\'язковим.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Невірний формат e-mail.';
        }

        if (trim($data['first_name'] ?? '') === '') {
            $errors['first_name'] = 'Ім\'я є обов\'язковим.';
        }

        if (trim($data['last_name'] ?? '') === '') {
            $errors['last_name'] = 'Прізвище є обов\'язковим.';
        }

        return $errors;
    }
}
