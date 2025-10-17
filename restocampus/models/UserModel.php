<?php
require_once "config/Db.php";

class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Db::getInstance()->getConnection();
    }

    // Vérifie login et mot de passe
    public function findByLoginPassword($login, $password) {
    $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE login = :login");
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Comparaison directe car mot de passe en clair
    if ($user && $password === $user['motDePasse']) {
        return $user;
    }
    return false;
}

}
