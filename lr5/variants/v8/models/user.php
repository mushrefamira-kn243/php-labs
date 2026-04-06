<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByLogin($login) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO users 
            (login, password, email, first_name, last_name, phone, city, gender, about) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['login'],
            $data['password'],
            $data['email'],
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['city'],
            $data['gender'],
            $data['about']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE users 
            SET email = ?, first_name = ?, last_name = ?, phone = ?, city = ?, gender = ?, about = ? 
            WHERE id = ?
        ");

        $stmt->execute([
            $data['email'],
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['city'],
            $data['gender'],
            $data['about'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}