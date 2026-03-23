<?php

class RegformController extends PageController
{
    public function action_form(): void
    {
        $errors = [];
        $old = [];

        if ($this->request->isPost()) {

            $old = $this->request->allPost();

            $errors = $this->validate($old);

            if (empty($errors)) {

                $_SESSION['reg_success'] = true;

                $_SESSION['reg_data'] = [
                    'login' => trim($old['login'] ?? ''),
                    'email' => trim($old['email'] ?? '')
                ];

                $this->redirect('regform/done');
                return;
            }
        }

        $this->render('regform/form', [
            'errors' => $errors,
            'old' => $old
        ], 'Реєстрація');
    }

    public function action_done(): void
    {
        if (empty($_SESSION['reg_success'])) {
            $this->redirect('regform/form');
            return;
        }

        $data = $_SESSION['reg_data'] ?? [];

        unset($_SESSION['reg_success'], $_SESSION['reg_data']);

        $this->render('regform/done', [
            'regData' => $data
        ], 'Реєстрація завершена');
    }

    private function validate(array $data): array
    {
        $errors = [];

        $login = trim($data['login'] ?? '');
        $password1 = $data['password1'] ?? '';
        $password2 = $data['password2'] ?? '';
        $email = trim($data['email'] ?? '');

        // LOGIN
        if ($login === '') {
            $errors['login'] = "Логін є обов'язковим.";
        }

        // PASSWORD
        if ($password1 === '') {
            $errors['password1'] = "Пароль є обов'язковим.";
        } else {

            if (strlen($password1) < 5) {
                $errors['password1'] = "Пароль має містити щонайменше 5 символів.";
            }

            elseif (!preg_match('/\d/', $password1)) {
                $errors['password1'] = "Пароль має містити хоча б одну цифру.";
            }
        }

        // PASSWORD CONFIRM
        if ($password2 === '') {
            $errors['password2'] = "Підтвердження пароля є обов'язковим.";
        }

        elseif ($password1 !== $password2) {
            $errors['password2'] = "Паролі не співпадають.";
        }

        // EMAIL
        if ($email === '') {
            $errors['email'] = "E-mail є обов'язковим.";
        }

        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Невірний формат e-mail.";
        }

        return $errors;
    }
}