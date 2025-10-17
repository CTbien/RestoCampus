<?php
class Db {
    private static $instance = null; // Instance unique
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=restocampus;charset=utf8", // nom de ta base
                "root",    // utilisateur MySQL
                "root"         // mot de passe MySQL
            );
            // Mode d'erreur : exceptions
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base : " . $e->getMessage());
        }
    }

    // Récupérer l'instance unique
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    // Récupérer l'objet PDO
    public function getConnection() {
        return $this->pdo;
    }
}
