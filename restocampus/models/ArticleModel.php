<?php
require_once "config/Db.php";

class ArticleModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Db::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT a.idArticle, a.nom, a.description,
                   GROUP_CONCAT(i.nom SEPARATOR ', ') AS ingredients
            FROM article a
            LEFT JOIN ingredient i ON i.idArticle = a.idArticle
            GROUP BY a.idArticle
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM article WHERE idArticle = :id");
        $stmt->execute(['id' => $id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt2 = $this->pdo->prepare("SELECT * FROM ingredient WHERE idArticle = :id");
        $stmt2->execute(['id' => $id]);
        $article['ingredients'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        return $article;
    }

    public function add($nom, $description, $ingredients = []) {
        $stmt = $this->pdo->prepare("INSERT INTO article (nom, description) VALUES (:nom, :description)");
        $stmt->execute(['nom' => $nom, 'description' => $description]);
        $articleId = $this->pdo->lastInsertId();

        foreach ($ingredients as $ing) {
            $stmt2 = $this->pdo->prepare("INSERT INTO ingredient (nom, idArticle) VALUES (:nom, :idArticle)");
            $stmt2->execute(['nom' => trim($ing), 'idArticle' => $articleId]);
        }
    }

    public function update($id, $nom, $description, $ingredients = []) {
        $stmt = $this->pdo->prepare("UPDATE article SET nom = :nom, description = :description WHERE idArticle = :id");
        $stmt->execute(['nom' => $nom, 'description' => $description, 'id' => $id]);

        $stmt2 = $this->pdo->prepare("DELETE FROM ingredient WHERE idArticle = :id");
        $stmt2->execute(['id' => $id]);

        foreach ($ingredients as $ing) {
            $stmt3 = $this->pdo->prepare("INSERT INTO ingredient (nom, idArticle) VALUES (:nom, :idArticle)");
            $stmt3->execute(['nom' => trim($ing), 'idArticle' => $id]);
        }
    }

    public function delete($id) {
        $stmt1 = $this->pdo->prepare("DELETE FROM ingredient WHERE idArticle = :id");
        $stmt1->execute(['id' => $id]);

        $stmt2 = $this->pdo->prepare("DELETE FROM article WHERE idArticle = :id");
        $stmt2->execute(['id' => $id]);
    }
}
