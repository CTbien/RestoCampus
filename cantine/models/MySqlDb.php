<?php
class MySqlDb {
    private static $pdo = null;

    public static function getPdo() {
        if (self::$pdo === null) {
            $dsn  = 'mysql:host=localhost;dbname=cantine;charset=utf8mb4';
            $user = 'root';
            $pass = 'root';
            self::$pdo = new PDO($dsn, $user, $pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$pdo;
    }
}

