<?php
require_once "models/ArticleDisponibleModel.php";

class ArticleDisponibleController {
    private $model;

    public function __construct() {
        $this->model = new ArticleDisponibleModel();
    }

    // Lister toutes les disponibilités
    public function lister() {
        $disponibilites = $this->model->getAll();
        require "views/dispo/list.php";
    }

    // Ajouter une disponibilité
    public function ajouter() {
        $articles = $this->model->getArticles();
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idArticle = $_POST['idArticle'] ?? null;
            $dateHeureDebut = $_POST['dateHeureDebut'] ?? null;
            $dateHeureFin = $_POST['dateHeureFin'] ?? null;
            $quantiteMax = $_POST['quantiteMax'] ?? null;

            // Validation simple
            if (!$idArticle || !$dateHeureDebut || !$dateHeureFin || !$quantiteMax) {
                $message = "Tous les champs sont obligatoires.";
            } elseif (strtotime($dateHeureFin) <= strtotime($dateHeureDebut)) {
                $message = "La date/heure de fin doit être après la date/heure de début.";
            } else {
                $this->model->add($idArticle, $dateHeureDebut, $dateHeureFin, $quantiteMax);
                header("Location: index.php?action=listerDispo");
                exit;
            }
        }

        require "views/dispo/add.php";
    }

    // Modifier une disponibilité
    public function modifier() {
        $idDispo = $_GET['id'] ?? null;
        if (!$idDispo) exit("ID manquant");

        $dispo = $this->model->getById($idDispo);
        $articles = $this->model->getArticles();
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idArticle = $_POST['idArticle'] ?? null;
            $dateHeureDebut = $_POST['dateHeureDebut'] ?? null;
            $dateHeureFin = $_POST['dateHeureFin'] ?? null;
            $quantiteMax = $_POST['quantiteMax'] ?? null;

            if (!$idArticle || !$dateHeureDebut || !$dateHeureFin || !$quantiteMax) {
                $message = "Tous les champs sont obligatoires.";
            } elseif (strtotime($dateHeureFin) <= strtotime($dateHeureDebut)) {
                $message = "La date/heure de fin doit être après la date/heure de début.";
            } else {
                $this->model->update($idDispo, $idArticle, $dateHeureDebut, $dateHeureFin, $quantiteMax);
                header("Location: index.php?action=listerDispo");
                exit;
            }
        }

        require "views/dispo/add.php"; // On réutilise le même formulaire que pour l'ajout
    }

    // Supprimer une disponibilité
    public function supprimer() {
        $idDispo = $_GET['id'] ?? null;
        if ($idDispo) {
            $this->model->delete($idDispo);
        }
        header("Location: index.php?action=listerDispo");
        exit;
    }
}
