<?php

class UploadController extends PageController
{
    private string $uploadDir;
    private array $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/pjpeg'];
    private array $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private int $maxSize = 5 * 1024 * 1024; // 5 MB

    public function __construct()
    {
        parent::__construct();
        $this->uploadDir = DATA_DIR . '/uploads';

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    public function action_index(): void
    {
        $message = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $file = $_FILES['image'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $error = 'Помилка завантаження файлу (код: ' . $file['error'] . ').';
            } elseif ($file['size'] > $this->maxSize) {
                $error = 'Максимальний розмір файлу: 5 МБ.';
            } else {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $realType = '';

                if (class_exists('finfo')) {
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $realType = $finfo->file($file['tmp_name']) ?: '';
                } elseif (function_exists('mime_content_type')) {
                    $realType = mime_content_type($file['tmp_name']) ?: '';
                } elseif (function_exists('getimagesize')) {
                    $imageData = getimagesize($file['tmp_name']);
                    $realType = $imageData ? image_type_to_mime_type($imageData[2]) : '';
                }

                if ($realType === '') {
                    if (!in_array($ext, $this->allowedExtensions, true)) {
                        $error = 'Невідомий тип файлу. Дозволені формати: JPEG, PNG, GIF, WebP.';
                    }
                } elseif (!in_array($ext, $this->allowedExtensions, true) || !in_array($realType, $this->allowedMimeTypes, true)) {
                    $error = 'Дозволені формати: JPEG, PNG, GIF, WebP.';
                }
            }
            if ($error === '' && isset($ext)) {
                $safeName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                $dest = $this->uploadDir . '/' . $safeName;

                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $message = 'Зображення "' . htmlspecialchars($file['name']) . '" завантажено!';
                } else {
                    $error = 'Не вдалося зберегти файл.';
                }
            }
        }

        $images = $this->getImages();

        $this->render('upload/index', [
            'images' => $images,
            'message' => $message,
            'error' => $error,
        ], 'Завантаження зображень');
    }

    private function getImages(): array
    {
        $images = [];
        $files = glob($this->uploadDir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);

        if ($files) {
            rsort($files);
            foreach ($files as $file) {
                $images[] = [
                    'name' => basename($file),
                    'url' => 'data/uploads/' . basename($file),
                    'size' => filesize($file),
                    'date' => date('Y-m-d H:i', filemtime($file)),
                ];
            }
        }

        return $images;
    }
}
