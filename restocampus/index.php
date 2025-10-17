<?php
session_start();
require_once "controllers/UserController.php";
require_once "controllers/ArticleController.php";
require_once "controllers/ArticleDisponibleController.php"; // <-- ajout

$userController = new UserController();
$articleController = new ArticleController();
$dispoController = new ArticleDisponibleController(); // <-- ajout

$action = $_GET['action'] ?? 'login';

switch ($action) {

    // --- Authentification ---
    case 'login':
        $userController->login();
        break;

    case 'verifier':
        $userController->verifier();
        break;

    case 'logout':
        $userController->logout();
        break;

    // --- Dashboard ---
    case 'dashboard':
        if (!isset($_SESSION['login'])) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SESSION['role'] === 'admin') {
            require "views/admin/dashboard.php";
        } else {
            require "views/student/dashboard.php";
        }
        break;

    // --- Gestion des articles ---
    case 'listerArticles':
        $articleController->lister();
        break;

    case 'ajouterArticle':
        $articleController->ajouter();
        break;

    case 'modifierArticle':
        $articleController->modifier();
        break;

    case 'supprimerArticle':
        $articleController->supprimer();
        break;

    // --- Gestion des disponibilités ---  <--- NOUVEAU
    case 'listerDispo':
        $dispoController->lister();
        break;

    case 'ajouterDispo':
        $dispoController->ajouter();
        break;

    case 'modifierDispo':
        $dispoController->modifier();
        break;

    case 'supprimerDispo':
        $dispoController->supprimer();
        break;

    default:
        echo "Page introuvable.";
        break;
}
