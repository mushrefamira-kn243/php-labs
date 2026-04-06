
<?php
require_once 'classes/Controller.php';

class UploadController extends Controller {
    public function index() {
        $images = glob('data/uploads/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        $this->view->render('upload/index', ['images' => $images]);
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (in_array($file['type'], $allowed) && $file['size'] <= 5 * 1024 * 1024) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $name = uniqid() . '.' . $ext;
                move_uploaded_file($file['tmp_name'], 'data/uploads/' . $name);
            }
        }
        header('Location: /upload');
    }
}