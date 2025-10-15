<?php
require_once __DIR__ . '/MySqlDb.php';

class UserModel {
    private $pdo;
    public function __construct() {
        $this->pdo = MySqlDb::getPdo();
    }

    public function findByLoginPassword($login, $password) {
        $sql = "SELECT * FROM users WHERE login='$login' AND password='$password' LIMIT 1";
        $stmt = $this->pdo->query($sql);
        return $stmt ? $stmt->fetch() : null;
    }

    
}
