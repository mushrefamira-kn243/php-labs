
<?php
require_once 'classes/Controller.php';

class DirectoriesController extends Controller {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $dir = 'data/users/' . $login;
            if (!is_dir($dir)) {
                mkdir($dir . '/video', 0777, true);
                mkdir($dir . '/music', 0777, true);
                mkdir($dir . '/photo', 0777, true);
                file_put_contents($dir . '/video/sample1.mp4', 'sample video');
                file_put_contents($dir . '/video/sample2.mp4', 'sample video');
                file_put_contents($dir . '/music/sample1.mp3', 'sample music');
                file_put_contents($dir . '/music/sample2.mp3', 'sample music');
                file_put_contents($dir . '/photo/sample1.jpg', 'sample photo');
                file_put_contents($dir . '/photo/sample2.jpg', 'sample photo');
                file_put_contents($dir . '/photo/sample3.jpg', 'sample photo');
            } else {
                echo 'Directory exists';
            }
        }
        $this->view->render('directories/create');
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $dir = 'data/users/' . $login;
            if (is_dir($dir)) {
                $this->deleteDir($dir);
            }
        }
        $this->view->render('directories/delete');
    }

    private function deleteDir($dir) {
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? $this->deleteDir($path) : unlink($path);
        }
        rmdir($dir);
    }
}