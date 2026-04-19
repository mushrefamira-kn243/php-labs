<?php

class RecipeController extends PageController
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    public function action_list(): void
    {
        $stmt = $this->db->query('SELECT * FROM instruments ORDER BY id DESC');
        $instruments = $stmt->fetchAll();

        $this->render('recipe/list', [
            'instruments' => $instruments,
        ], 'Програма навчання');
    }

    public function action_create(): void
    {
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $_POST;
            $errors = $this->validate($old);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'INSERT INTO instruments (name, type, brand, price, condition)
                     VALUES (:name, :type, :brand, :price, :condition)'
                );
                $stmt->execute([
                    ':name' => trim($old['name']),
                    ':type' => trim($old['type']),
                    ':brand' => trim($old['brand'] ?? ''),
                    ':price' => (float)($old['price'] ?? 0),
                    ':condition' => trim($old['condition'] ?? ''),
                ]);

                $_SESSION['flash_success'] = 'Інструмент "' . trim($old['name']) . '" додано!';
                header('Location: index.php?route=recipe/list');
                exit;
            }
        }

        $this->render('recipe/create', [
            'errors' => $errors,
            'old' => $old,
        ], 'Додати інструмент');
    }

    public function action_edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            header('Location: index.php?route=recipe/list');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM instruments WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $instrument = $stmt->fetch();

        if (!$instrument) {
            header('Location: index.php?route=recipe/list');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $errors = $this->validate($data);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'UPDATE instruments SET name = :name, type = :type, brand = :brand,
                     price = :price, condition = :condition WHERE id = :id'
                );
                $stmt->execute([
                    ':name' => trim($data['name']),
                    ':type' => trim($data['type']),
                    ':brand' => trim($data['brand'] ?? ''),
                    ':price' => (float)($data['price'] ?? 0),
                    ':condition' => trim($data['condition'] ?? ''),
                    ':id' => $id,
                ]);

                $_SESSION['flash_success'] = 'Інструмент оновлено!';
                header('Location: index.php?route=recipe/list');
                exit;
            }

            $instrument = array_merge($instrument, $data);
        }

        $this->render('recipe/edit', [
            'instrument' => $instrument,
            'errors' => $errors,
        ], 'Редагувати інструмент');
    }

    public function action_delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);

            if ($id > 0) {
                $stmt = $this->db->prepare('DELETE FROM instruments WHERE id = :id');
                $stmt->execute([':id' => $id]);
                $_SESSION['flash_success'] = 'Інструмент видалено!';
            }
        }

        header('Location: index.php?route=recipe/list');
        exit;
    }

    private function validate(array $data): array
    {
        $errors = [];

        if (trim($data['name'] ?? '') === '') {
            $errors['name'] = 'Назва інструменту є обов\'язковою.';
        }

        if (trim($data['type'] ?? '') === '') {
            $errors['type'] = 'Тип інструменту є обов\'язковим.';
        }

        $price = $data['price'] ?? '';
        if ($price !== '' && (!is_numeric($price) || (float)$price < 0)) {
            $errors['price'] = 'Ціна має бути додатнім числом.';
        }

        return $errors;
    }
}
