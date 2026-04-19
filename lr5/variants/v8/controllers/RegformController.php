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
                    'student_name' => trim($old['student_name'] ?? ''),
                    'contact_email' => trim($old['contact_email'] ?? ''),
                    'phone' => trim($old['phone'] ?? ''),
                    'instrument' => trim($old['preferred_instrument'] ?? ''),
                    'experience' => trim($old['experience_level'] ?? ''),
                    'preferred_date' => trim($old['preferred_date'] ?? ''),
                    'notes' => trim($old['notes'] ?? ''),
                ];

                $this->redirect('regform/done');
                return;
            }
        }

        $this->render('regform/form', [
            'errors' => $errors,
            'old' => $old,
        ], 'Запис на пробне заняття');
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
            'regData' => $data,
        ], 'Заявка прийнята');
    }

    private function validate(array $data): array
    {
        $errors = [];
        $name = trim($data['student_name'] ?? '');
        $email = trim($data['contact_email'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $instrument = trim($data['preferred_instrument'] ?? '');
        $experience = $data['experience_level'] ?? '';
        $date = trim($data['preferred_date'] ?? '');

        if ($name === '') {
            $errors['student_name'] = 'Ім’я учня є обов’язковим.';
        }

        if ($email === '') {
            $errors['contact_email'] = 'E-mail є обов’язковим.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['contact_email'] = 'Невірний формат e-mail.';
        }

        if ($phone === '') {
            $errors['phone'] = 'Контактний телефон є обов’язковим.';
        }

        if ($instrument === '') {
            $errors['preferred_instrument'] = 'Оберіть інструмент або напрямок.';
        }

        if (!in_array($experience, ['beginner', 'intermediate', 'advanced'], true)) {
            $errors['experience_level'] = 'Оберіть ваш рівень.';
        }

        if ($date === '') {
            $errors['preferred_date'] = 'Оберіть бажану дату заняття.';
        }

        return $errors;
    }
}
