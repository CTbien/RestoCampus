<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once "controllers/UserController.php";
require_once "controllers/ArticleController.php";
require_once "controllers/ArticleDisponibleController.php";
require_once "controllers/CommandeController.php";

$userController      = new UserController();
$articleController   = new ArticleController();
$dispoController     = new ArticleDisponibleController();
$commandeController  = new CommandeController();


function requireLogin() {
    if (!isset($_SESSION['login'])) {
        header("Location: index.php?action=login");
        exit();
    }
}

function requireRole(string $role) {
    if (!isset($_SESSION['login'])) {
        header("Location: index.php?action=login");
        exit();
    }
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        echo "<h2 style='color:red;'>Accès refusé : réservé aux utilisateurs de type <b>$role</b>.</h2>";
        echo "<p><a href='index.php?action=dashboard'>Retour au tableau de bord</a></p>";
        exit();
    }
}

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
        requireLogin();
        if ($_SESSION['role'] === 'admin') {
            header("Location: index.php?action=dashboardAdmin");
            exit();
        } else {
            require "views/student/dashboard.php";
        }
        break;

    // --- Dashboard Admin ---
    case 'dashboardAdmin':
        requireRole('admin');
        $commandeController->dashboardAdmin();
        break;

    // --- Gestion des utilisateurs (admin) ---
    case 'listerUsers':
        requireRole('admin');
        $userController->listerUsers();
        break;

    case 'ajouterUser':
        requireRole('admin');
        $userController->ajouterUser();
        break;

    case 'modifierUser':
        requireRole('admin');
        $userController->modifierUser();
        break;

    case 'supprimerUser':
        requireRole('admin');
        $userController->supprimerUser();
        break;

    // --- Gestion des articles ---
    case 'listerArticles':
        requireRole('admin');
        $articleController->lister();
        break;

    case 'ajouterArticle':
        requireRole('admin');
        $articleController->ajouter();
        break;

    case 'modifierArticle':
        requireRole('admin');
        $articleController->modifier();
        break;

    case 'supprimerArticle':
        requireRole('admin');
        $articleController->supprimer();
        break;

    // --- Gestion des disponibilités ---
    case 'listerDispo':
        requireRole('admin');
        $dispoController->lister();
        break;

    case 'ajouterDispo':
        requireRole('admin');
        $dispoController->ajouter();
        break;

    case 'modifierDispo':
        requireRole('admin');
        $dispoController->modifier();
        break;

    case 'supprimerDispo':
        requireRole('admin');
        $dispoController->supprimer();
        break;

    // --- Gestion des commandes (étudiants) ---
    case 'reserver':
        requireRole('etudiant');
        $commandeController->reserver();
        break;

    case 'mesCommandes':
        requireRole('etudiant');
        $commandeController->mesCommandes();
        break;

    case 'annuler':
        requireRole('etudiant');
        $commandeController->annuler();
        break;

    // --- Marquer une commande comme récupérée (admin) ---
    case 'marquerRecuperee':
        requireRole('admin');
        $commandeController->marquerRecuperee();
        break;

    default:
        echo "<h1>Page introuvable.</h1>";
        break;
}
