<?php

class Instrument {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM instruments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM instruments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO instruments (name, type, brand, price, `condition`) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['name'],
            $data['type'],
            $data['brand'],
            $data['price'],
            $data['condition']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE instruments 
            SET name = ?, type = ?, brand = ?, price = ?, `condition` = ? 
            WHERE id = ?
        ");
        $stmt->execute([
            $data['name'],
            $data['type'],
            $data['brand'],
            $data['price'],
            $data['condition'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM instruments WHERE id = ?");
        $stmt->execute([$id]);
    }
}