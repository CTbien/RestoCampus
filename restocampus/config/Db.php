<?php
class Db {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=restocampus;charset=utf8",
                "root",    
                "root"        
            );
            
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
