
<?php
require_once 'classes/Controller.php';
require_once 'models/User.php';

class AuthController extends Controller {
    private $model;

    public function __construct() {
        global $pdo;
        $this->model = new User($pdo);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'login' => $_POST['login'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'city' => $_POST['city'],
                'gender' => $_POST['gender'],
                'about' => $_POST['about']
            ];
            if ($this->validate($data)) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $this->model->add($data);
                header('Location: /auth/login');
            }
        }
        $this->view->render('auth/register');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model->getByLogin($_POST['login']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /auth/profile');
            }
        }
        $this->view->render('auth/login');
    }

    public function profile() {
        $user = $this->model->getById($_SESSION['user_id']);
        $this->view->render('auth/profile', ['user' => $user]);
    }

    public function edit() {
        $user = $this->model->getById($_SESSION['user_id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => $_POST['email'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'city' => $_POST['city'],
                'gender' => $_POST['gender'],
                'about' => $_POST['about']
            ];
            $this->model->update($_SESSION['user_id'], $data);
            header('Location: /auth/profile');
        }
        $this->view->render('auth/edit', ['user' => $user]);
    }

    public function delete() {
        $this->model->delete($_SESSION['user_id']);
        session_destroy();
        header('Location: /');
    }

    public function logout() {
        session_destroy();
        header('Location: /');
    }

    private function validate($data) {
        return strlen($data['password']) >= 5 && preg_match('/\d/', $data['password']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    }
}