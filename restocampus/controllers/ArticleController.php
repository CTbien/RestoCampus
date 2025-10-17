<?php
require_once "models/ArticleModel.php";

class ArticleController {
    private $model;

    public function __construct() {
        $this->model = new ArticleModel();
    }

    public function lister() {
        $articles = $this->model->getAll();
        require "views/article/list.php";
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $ingredients = isset($_POST['ingredients']) ? explode(',', $_POST['ingredients']) : [];

            $this->model->add($nom, $description, $ingredients);
            header("Location: index.php?action=listerArticles");
            exit;
        }
        require "views/article/add.php";
    }

    public function modifier() {
        $id = $_GET['id'] ?? null;
        if (!$id) exit("ID manquant");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $ingredients = isset($_POST['ingredients']) ? explode(',', $_POST['ingredients']) : [];

            $this->model->update($id, $nom, $description, $ingredients);
            header("Location: index.php?action=listerArticles");
            exit;
        }

        $article = $this->model->getById($id);
        require "views/article/edit.php";
    }

    public function supprimer() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header("Location: index.php?action=listerArticles");
        exit;
    }
}
