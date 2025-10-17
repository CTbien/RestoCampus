<?php
require_once "config/Db.php";

// Récupérer la connexion PDO
$db = Db::getInstance()->getConnection();

if ($db) {
    echo "Connexion réussie à la base de données !";
} else {
    echo "Échec de la connexion.";
}
